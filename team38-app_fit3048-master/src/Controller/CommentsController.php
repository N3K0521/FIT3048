<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('dashboard');

       $allCommets=$this->fetchTable('Comments')->find('all',['conditions'=>['Files.user_id'=>$this->Auth->User('id')]])->contain(['Files'])
       ->order(['Comments.create_date'=>'Desc'])->all();

        $this->set(compact('allCommets'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($fileId = null,$fileName=null, $user_id=null)
    {
        $this->viewBuilder()->setLayout('dashboard');
        $allCommets=$this->fetchTable('Comments')->find('all',['conditions'=>['file_id'=>$fileId]])
        ->order(['Comments.create_date'=>'Desc'])->all();
        $comment = $this->Comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment->create_date=FrozenTime::now();
            $comment->user_id=$this->Auth->User('id');
            $comment->file_id=$fileId;
            $comment->status=0;
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['controller'=>'Files','action' => 'index',$user_id]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }


        $this->set(compact('allCommets','fileName','user_id','comment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($fileId = null,$fileName=null, $user_id=null)
    {

        $this->viewBuilder()->setLayout('dashboard');
        $comment = $this->Comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment->create_date=FrozenTime::now();
            $comment->user_id=$this->Auth->User('id');
            $comment->file_id=$fileId;
            $comment->status=0;
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['controller'=>'Files','action' => 'index',$user_id]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }

        $this->set(compact('comment','fileName','user_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list', ['limit' => 200])->all();
        $files = $this->Comments->Files->find('list', ['limit' => 200])->all();
        $this->set(compact('comment', 'users', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    function read($id=null){
        $comment = $this->Comments->get($id, [
            'contain' => [],
        ]);
        $comment->status=1;
        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('Mark as read successfully.'));

            $allUnreadComments= $this->Comments->find('all',
            ['conditions'=>['AND'=>['Files.user_id'=>$this->request->getSession()->read('Auth')['User']['id'],'status'=>'0']]])
            ->contain(['Files'])->count();
            $this->getRequest()->getSession()->write('notification', $allUnreadComments);
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Mark as read Failed. Please, try again.'));
    }
}
