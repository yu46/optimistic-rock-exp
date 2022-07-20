<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationSlotsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReservationSlotsTable Test Case
 */
class ReservationSlotsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationSlotsTable
     */
    protected $ReservationSlots;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ReservationSlots',
        'app.EventDates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ReservationSlots') ? [] : ['className' => ReservationSlotsTable::class];
        /** @var  \App\Model\Table\ReservationSlotsTable $table */
        $table = $this->getTableLocator()->get('ReservationSlots', $config);
        $this->ReservationSlots = $table;
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ReservationSlots);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReservationSlotsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ReservationSlotsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testPatchAdminAddEntity(): void
    {
        $newEntity = $this->ReservationSlots->newEmptyEntity();
        $data = [
            'event_date_id' => '1',
            'time_from' => '09:00',
            'time_to' => '10:00',
            'max' => 10,
        ];
        $actual = $this->ReservationSlots->patchAdminAddEntity($newEntity, $data);
        $this->assertSame($data['max'], $actual->remaining);
        $this->assertSame(0, $actual->version);
        $this->assertSame([], $actual->getErrors());
    }
}
