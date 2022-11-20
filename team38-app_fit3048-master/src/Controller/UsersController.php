<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Event\EventInterface;

use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow users to logout and reset their password
        $this->Auth->allow(['login', 'register', 'password', 'reset','logout']);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('dashboard');
        $users=$this->Users->find('all');

        $this->set('users',$users);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Files'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('dashboard');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $query = $this->Users->findByUserEmail($this->getRequest()->getdata('user_email'));

            $users = $query->first();
            if (is_null($users)) {
                $user = $this->Users->patchEntity($user, $this->request->getData());

                $user->registered_timestamp=FrozenTime::now();

                if ($this->Users->save($user)) {
                    mkdir(WWW_ROOT.'user_uploads'.DS.$user->id, 0777, true);
                    $this->Flash->success(__('The user has been created.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be created. Please, try again.'));
            } else {
                $this->Flash->error(__('The email has been created. Please try another one.'));
            }

        }
        $this->set(compact('user'));

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard');
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->getRequest()->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                $contactus_model = $this->getTableLocator()->get('Contactus');
                $contactus_details = $contactus_model->find('all')->all()->first();
                $this->getRequest()->getSession()->write('contactus_details', $contactus_details);

                if ($user['user_type'] == 'staff'){
                    return $this->redirect(['controller'=>'Users','action'=>'search']);
                }
                else if ($user['user_type'] == 'client'){
                    return $this->redirect(['controller'=>'Files','action'=>'index', $user['id']]);
                }
                else if ($user['user_type'] == 'admin'){
                    return $this->redirect(['controller'=>'Users','action'=>'index']);
                }
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function password()
    {
        $this->viewBuilder()->setLayout('login');
        if ($this->getRequest()->is('post')) {
            $query = $this->Users->findByUserEmail($this->getRequest()->getdata('user_email'));

            $users = $query->first();
            if (is_null($users)) {
                $this->Flash->error('Email address does not exist. Please try again');
            } else {

                $passkey = uniqid();

                $url = Router::Url(['controller' => 'Users', 'action' => 'reset'], true) . '/' . $passkey;
                $timeout = time() + DAY;
                if ($this->Users->updateAll(['passkey' => $passkey, 'timeout' => $timeout], ['id' => $users->id])) {

                    $this->sendResetEmail($url, $users);
                    $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error('Error saving reset passkey/timeout');
                }
            }
        }
    }

    private function sendResetEmail($url, $users)
    {
        $email = new Email('default');
        $email->viewBuilder()->setTemplate('resetpw');
        $email->setEmailFormat('html');

        $email->setTo($users->user_email);
        $email->setSubject('Reset your password');
        $email->setViewVars(['url' => $url, 'user_lname' => $users->user_lname, 'user_fname' => $users->user_fname]);
        if ($email->send()) {
            $this->Flash->success(__('Check your email for your reset password link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
    }

    public function reset($passkey = null)
    {
        $this->viewBuilder()->setLayout('login');
        if ($passkey) {
            $query = $this->Users->find('all', ['conditions' => ['passkey' => $passkey, 'timeout >' => time()]]);
            $users = $query->first();
            if ($users) {
                if (!empty($this->getRequest()->getData())) {
                    // Clear passkey and timeout
                    $this->getRequest()->getdata('passkey') == null;
                    $this->getRequest()->getdata('timeout') == null;
                    $users = $this->Users->patchEntity($users, $this->getRequest()->getdata());
                    $users->user_password = $this->getRequest()->getdata()['password'];

                    if ($this->Users->save($users)) {

                        $this->Flash->success(__('Your password has been successfully reset.'));
                        return $this->redirect(['action' => 'login']);
                    } else {
                        $this->Flash->error(__('Your password could not be reset. Please, try again.'));
                    }
                }
            } else {
                $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
                $this->redirect(['action' => 'password']);
            }

            unset($users->password);
            $this->set(compact('users'));
        } else {
            $this->redirect('/');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out');
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard()
    {
        $this->viewBuilder()->setLayout('dashboard');
    }

    public function search()
    {
        $this->viewBuilder()->setLayout('dashboard');
        $allClient=$this->Users->find('all')->where('user_type ="client"');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $keyword=$this->request->getData()["keyword"];
            $allClient=$this->Users->find('all')->where('user_type ="client" and(concat_ws(" ",user_firstname,user_lastname) like "%'.$keyword.'%" )');


        }
        $this->set('allClient',$allClient);
    }

}
