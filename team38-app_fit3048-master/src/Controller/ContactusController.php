<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contactus Controller
 *
 * @property \App\Model\Table\ContactusTable $Contactus
 * @method \App\Model\Entity\Contactus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $contactus = $this->paginate($this->Contactus);

        $this->set(compact('contactus'));
    }

    /**
     * View method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactus = $this->Contactus->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('contactus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactus = $this->Contactus->newEmptyEntity();
        if ($this->request->is('post')) {
            $contactus = $this->Contactus->patchEntity($contactus, $this->request->getData());
            if ($this->Contactus->save($contactus)) {
                $this->Flash->success(__('The contactus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contactus could not be saved. Please, try again.'));
        }
        $this->set(compact('contactus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('dashboard');


        $contactus = $this->Contactus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactus = $this->Contactus->patchEntity($contactus, $this->request->getData());
            if ($this->Contactus->save($contactus)) {
                $this->Flash->success(__('Contact Info has been updated. Please restart to see changes'));

                return $this->redirect(['action' => 'edit', 1]);
            }
            $this->Flash->error(__('The contactus could not be saved. Please, try again.'));
        }
        $this->set(compact('contactus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contactus id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactus = $this->Contactus->get($id);
        if ($this->Contactus->delete($contactus)) {
            $this->Flash->success(__('The contactus has been deleted.'));
        } else {
            $this->Flash->error(__('The contactus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
