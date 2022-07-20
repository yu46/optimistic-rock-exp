<?php
declare(strict_types=1);

namespace App\Controller\Admin\Api;

use App\Controller\AppController;

/**
 * ReservationSlots Controller
 *
 * @property \App\Model\Table\ReservationSlotsTable $ReservationSlots
 * @method \App\Model\Entity\ReservationSlot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationSlotsController extends AppController
{
    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');

        $this->viewBuilder()
            ->setClassName('Json');
        $this->set('_serialize', 'response');
    }

    /**
     * @param  string  $eventId  event_id
     * @return void
     */
    public function dates(string $eventId)
    {
        $EventDates = $this->ReservationSlots->EventDates;
        $dates = $EventDates
            ->find()
            ->where([$EventDates->aliasField('event_id') => $eventId])
            ->orderAsc($EventDates->aliasField('date'))
            ->toArray();

        $this->set(['response' => $dates]);
    }
}
