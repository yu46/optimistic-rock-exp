<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * ReservationSlots Controller
 *
 * @property \App\Model\Table\ReservationSlotsTable $ReservationSlots
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationSlotsController extends AdminBaseController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventDates'],
        ];
        $reservationSlots = $this->paginate($this->ReservationSlots);

        $this->set(compact('reservationSlots'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservationSlot = $this->ReservationSlots->newEmptyEntity();

        if ($this->request->is('post')) {
            $reservationSlot = $this->ReservationSlots
                ->patchAdminAddEntity($reservationSlot, $this->request->getData());
            if ($this->ReservationSlots->save($reservationSlot)) {
                $this->Flash->success(__('The reservation slot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation slot could not be saved. Please, try again.'));
        }

        $this->set(compact('reservationSlot'));
    }

    /**
     * Delete method
     *
     * @param string $id Reservation Slot id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(string $id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservationSlot = $this->ReservationSlots->get($id);
        if ($this->ReservationSlots->delete($reservationSlot)) {
            $this->Flash->success(__('The reservation slot has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation slot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
