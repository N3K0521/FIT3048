<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\graphMailer;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($user_id = null)
    {
        $this->set('title', 'View Messages');

        $this->viewBuilder()->setLayout('dashboard');
        $this->paginate = [
            'contain' => ['Users'], 'order' => ['date' => 'desc']
        ];

        $default_order = $this->Messages->find('all')->where(['client_id' => (int)$user_id]);

        $messages = $this->paginate($default_order);

        $this->set('user_id', $user_id);

        $this->set(compact('messages'));
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $user_id = null)
    {
        $this->viewBuilder()->setLayout('dashboard');

        $message = $this->Messages->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('user_id', $user_id);

        $this->set(compact('message'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        $api_model = $this->getTableLocator()->get('Graphapi');
        $api_details = $api_model->find('all')->all()->first();

        $graphMailer = new graphMailer($api_details->tenant_id, $api_details->client_id, $api_details->client_secret);

        $messages = $graphMailer->getMessages($api_details->email);


        if($messages)
        {
            foreach($messages as $email)
            {
                $message = $this->Messages->newEmptyEntity();

                $client_id = NULL;

                $users = $this->getTableLocator()->get('Users');
                $client_id_sender = $users->find('all')->where(['user_email' => $email['sender']->emailAddress->address])->first();
                if (gettype($client_id_sender) != 'NULL'){
                    if ($client_id_sender->user_type == 'client'){
                        $client_id = $client_id_sender->id;
                    }
                }
                $receivers = $email['toRecipientsBasic'];
                foreach($receivers as $receiver){
                    $client_id_receiver = $users->find('all')->where(['user_email' => $receiver])->first();
                    if (gettype($client_id_receiver) != 'NULL'){
                        if ($client_id_receiver->user_type == 'client'){
                            $client_id = $client_id_receiver->id;
                        }
                    }
                }

                $message->body = $email['body']->content;
                $message->date = strtotime($email['sentDateTime']);
                $message->subject = $email['subject'];
                $message->sender = $email['sender']->emailAddress->address;
                $message->receiver = implode(", ", $email['toRecipientsBasic']);
                $message->cc = implode(", ", $email['ccRecipientsBasic']);
                $message->client_id = $client_id;


                if (gettype($client_id)!='NULL'){
                    $graphMailer->deleteEmail($api_details->email, $email['id'], false);
                    if (!$this->Messages->save($message)) {
                        $this->Flash->error(__('Error saving message'));
                    }
                }

            }
        }

        $this->Flash->success(__('All messages have been updated.'));
        return $this->redirect(['action'=>'index', $user_id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'));
        }
        $users = $this->Messages->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('message', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
