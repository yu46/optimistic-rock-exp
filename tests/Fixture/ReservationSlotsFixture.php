<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationSlotsFixture
 */
class ReservationSlotsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'max' => 1,
                'remaining' => 1,
                'time_from' => '11:54:09',
                'time_to' => '11:54:09',
                'version' => 1,
                'event_date_id' => 1,
                'created' => '2022-07-07 11:54:09',
                'modified' => '2022-07-07 11:54:09',
            ],
        ];
        parent::init();
    }
}
