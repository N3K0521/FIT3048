<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Graphapi Controller
 *
 * @property \App\Model\Table\GraphapiTable $Graphapi
 * @method \App\Model\Entity\Graphapi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GraphapiController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $graphapi = $this->paginate($this->Graphapi);

        $this->set(compact('graphapi'));
    }

    /**
     * View method
     *
     * @param string|null $id Graphapi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $graphapi = $this->Graphapi->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('graphapi'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $graphapi = $this->Graphapi->newEmptyEntity();
        if ($this->request->is('post')) {
            $graphapi = $this->Graphapi->patchEntity($graphapi, $this->request->getData());
            if ($this->Graphapi->save($graphapi)) {
                $this->Flash->success(__('The graphapi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The graphapi could not be saved. Please, try again.'));
        }
        $this->set(compact('graphapi'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Graphapi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $this->viewBuilder()->setLayout('dashboard');

        $graphapi = $this->Graphapi->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $graphapi = $this->Graphapi->patchEntity($graphapi, $this->request->getData());
            if ($this->Graphapi->save($graphapi)) {
                $this->Flash->success(__('The API details have been saved.'));

                return $this->redirect(['action' => 'edit', 1]);
            }
            $this->Flash->error(__('The details could not be saved. Please, try again.'));
        }
        $this->set(compact('graphapi'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Graphapi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $graphapi = $this->Graphapi->get($id);
        if ($this->Graphapi->delete($graphapi)) {
            $this->Flash->success(__('The graphapi has been deleted.'));
        } else {
            $this->Flash->error(__('The graphapi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
