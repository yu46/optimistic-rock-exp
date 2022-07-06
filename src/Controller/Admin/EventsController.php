<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AdminBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->Events->EventDates->convertForInsert($this->request->getData());
            $event = $this->Events->patchAdminAddEntity($event, $data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
    }

    /**
     * Edit method
     *
     * @param string $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException if the record with such id
     * could not be found
     */
    public function edit(string $id)
    {
        $event = $this->Events->get($id, [
            'contain' => ['EventDates'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Events->EventDates->convertForUpdate($this->request->getData(), $event->event_dates);
            $event = $this->Events->patchAdminAddEntity($event, $data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The {0} has been saved.', 'Event'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Event'));
        }
        $this->set(compact('event'));
    }

    /**
     * Delete method
     *
     * @param string $id Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(string $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
