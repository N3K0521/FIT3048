<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use ZipArchive;
use Cake\Mailer\Email;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($user_id = null,$keyword=null)
    {
        $this->set('title', 'View Active Users');

        $this->viewBuilder()->setLayout('dashboard');
        $this->paginate = [
            'contain' => ['Users'], 'order' => ['timestamp' => 'desc']
        ];

        $default_order= $this->fetchTable('Comments')->find('all');
        $default_order
        ->select(['files.id','files.fileName','files.fileAddress','files.fileType','files.user_id','files.timestamp','files.uploaded_by_name','count'=>$default_order->func()->count('comments')])
        ->join(['table'=>'files','type'=>'right','conditions'=>'files.id=comments.file_id'])
        ->where(['files.user_id' => (int)$user_id])
        ->group('files.id');
        // var_dump($default_order);
        if($keyword){
            $default_order->where('fileName like "%'.$keyword.'%"');
        }
        $files = $this->paginate($default_order);

        $users = $this->getTableLocator()->get('Users');
        $belongs_to = $users->find('all')->where(['id' => (int)$user_id])->first();
        $this->set('test', $users->find('all')->where(['id' => (int)$user_id])->first());
        $this->set('name', $belongs_to);
        $this->set('type', $this->Auth->User('user_type'));

        $this->set(compact('files','keyword','user_id'));
    }


    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($belongs_to = null, $zipfile = null)
    {
        $this->viewBuilder()->setLayout('dashboard');

        $this->set('belongs_to', $belongs_to);
        $this->set('zipfile', $zipfile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($belongs_to = null)
    {
        $this->viewBuilder()->setLayout('dashboard');
        $file = $this->Files->newEmptyEntity();

        $uploads = $this->request->getData('upload');
        $fileNames=[];

        if ($this->request->is('post')) {
            foreach ($uploads as $upload){
                $file = $this->Files->newEntity($this->request->getData());
                $file->user_id = $belongs_to;
                $file->uploaded_by = $this->Auth->User('id');
                $file->uploaded_by_name = $this->Auth->User('user_firstname').' '.$this->Auth->User('user_lastname');
                $file->timestamp = FrozenTime::now();
                $file->fileType = 'unidentified';

                if(!$file->getErrors){

                    $file_size = $upload->getSize();
                    if ($file_size > 500*1048576){
                        $this->Flash->error(__('File too large'));
                        return $this->redirect(['action' => 'add', $belongs_to]);
                    }

                    $name = $upload->getClientFilename();
                    if ($name == null){
                        $this->Flash->error(__('No file uploaded. Please choose a file and try again'));
                        return $this->redirect(['action' => 'add', $belongs_to]);
                    }
                    array_push($fileNames,$name);
                    $targetPath = WWW_ROOT.'user_uploads'.DS.$file->user_id.DS.$name;
                    $file->fileAddress = $targetPath;
                    $file->fileType = $upload->getClientMediaType();

                    $same_file = $this->Files->find('all')->where(['fileName' => $name])->first();
                    if (gettype($same_file) != 'NULL'){
                        $this->Flash->error(__('One or more files have a similar name to a previously uploaded file. Please delete this file or rename the one you are uploading.'));
                        return $this->redirect(['action' => 'index', $file->user_id]);
                    }

                    if($name){
                        $upload->moveTo($targetPath);
                        chmod($targetPath,0777);

                        $file->fileName = $name;
                    }
                }

                if (!$this->Files->save($file)) {
                    $this->Flash->error(__('The file could not be saved. Please, try again.'));
                }

            }
            if($this->Auth->User('user_type')=='client'){ //send email
                $filename_string=implode(',',$fileNames);
                //all staff user
                $allStaff=$this->fetchTable('Users')->find('all',['conditions'=>['user_type'=>'staff']])->all();
                foreach($allStaff as $allStaff2){
                    $email = new Email('default');
                    $email->viewBuilder()->setTemplate('updatefile');
                    $email->setEmailFormat('html');

                    $email->setTo($allStaff2['user_email']);
                    $email->setSubject('new upload file');
                    $email->setViewVars(['operation' => 'upload', 'filename_string' => $filename_string, 'client_name' => $this->Auth->User('user_firstname').' '.$this->Auth->User('user_lastname')]);
                    $email->send();
                }
            }
            $this->Flash->success(__('The file has been saved.'));
            return $this->redirect(['action' => 'index', $file->user_id]);
        }
        $users = $this->Files->Users->find('list', ['limit' => 200])->all();

        $this->set('belongs_to', $belongs_to);


        $this->set(compact('file', 'users'));
    }

    /**
     * Download method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful download, renders view otherwise.
     */
    public function sendFile($id)
    {
        $zip_files = glob(WWW_ROOT.DS.'zip_files'.DS.'*');
        foreach ($zip_files as $zip_file){
            unlink($zip_file);
        }
        $file = $this->Files->get($id);
        $response = $this->response->withFile(
            $file['fileAddress'],
            ['download' => true, 'name' => $file['fileName']]
        );
        // Return the response to prevent controller from trying to render
        // a view.
        return $response;
    }

    /**
     * Download Zip method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful download, renders view otherwise.
     */
    public function sendZip($zip)
    {
        $response = $this->response->withFile(
            "zip_files/".$zip,
            ['download' => true, 'name' => $zip]
        );
        // Return the response to prevent controller from trying to render
        // a view.
        return $response;
    }

    /**
     * Download zip file of selected files
     *
     * @return \Cake\Http\Response|null|void Redirects on successful download, renders view otherwise.
     */
    public function downloadzip($u_id=null)
    {
        if (isset($this->request->getData()['search'])) {
            $keyword=$this->request->getData()["keyword"];

            return $this->redirect(['action' => 'index', $u_id,$keyword]);
        }
        else{
            $selections = $this->request->getData()['fileid'];

            $zip = new ZipArchive;
            $zip_name = uniqid();
            $res = $zip->open("zip_files/{$zip_name}.zip", ZipArchive::CREATE);

            $count = 0;
            foreach ($selections as $selection){
                if(intval($selection)){
                    $tempuser_file = $this->Files->find('all')->where(['id' => intval($selection)])->first();
                    $user_id = $tempuser_file->user_id;
                    $count += 1;
                    $zip->addFile($tempuser_file->fileAddress, $tempuser_file->fileName);
                }
            }
            $zip->close();

            if ($count>0){
                return $this->redirect(['action' => 'view', $user_id, "{$zip_name}.zip"]);
            }
            else{
                return $this->redirect(['action' => 'index', $u_id]);
            }
        }



    }


    public function rename(){
        $data=$this->request->getData();
        $query = $this->Files->find('all',['conditions'=>['fileName'=>$this->getRequest()->getdata('filename')]]);

        $searchFile = $query->first();
        if (is_null($searchFile)) {
            $file = $this->Files->get($data['fileid'], [
                'contain' => [],
            ]);
            rename(WWW_ROOT.'user_uploads'.DS.$file->user_id.DS.$file['fileName'], WWW_ROOT.'user_uploads'.DS.$file->user_id.DS.$data['filename']);
            $file->fileAddress = WWW_ROOT.'user_uploads'.DS.$file->user_id.DS.$data['filename'];
            $file->fileName=$data['filename'];
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been renamed.'));
                return $this->redirect(['action' => 'index', $data['userid']]);
            }
            $this->Flash->error(__('The file could not be renamed. Please, try again.'));
        }else{
            $this->Flash->error(__('The file name is existed. Please try another one.'));
            return $this->redirect(['action' => 'index', $data['userid']]);
        }


    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $users = $this->Files->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('file', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);

        if ($this->Files->delete($file)) {
            unlink(WWW_ROOT.'user_uploads'.DS.$file->user_id.DS.$file->fileName);


            if($this->Auth->User('user_type')=='client'){ //send email

                //all staff user
                $allStaff=$this->fetchTable('Users')->find('all',['conditions'=>['user_type'=>'staff']])->all();
                foreach($allStaff as $allStaff2){
                    $email = new Email('default');
                    $email->viewBuilder()->setTemplate('updatefile');
                    $email->setEmailFormat('html');

                    $email->setTo($allStaff2['user_email']);
                    $email->setSubject('delete file');
                    $email->setViewVars(['operation' => 'delete', 'filename_string' => $file['fileName'], 'client_name' => $this->Auth->User('user_firstname').' '.$this->Auth->User('user_lastname')]);
                    $email->send();
                }
            }

            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', $file->user_id]);
    }
}
