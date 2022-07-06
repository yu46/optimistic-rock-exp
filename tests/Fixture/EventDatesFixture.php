<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventDatesFixture
 */
class EventDatesFixture extends TestFixture
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
                'date' => '2022-07-01',
                'event_id' => 1,
            ],
            [
                'id' => 2,
                'date' => '2022-07-02',
                'event_id' => 1,
            ],
        ];
        parent::init();
    }
}
