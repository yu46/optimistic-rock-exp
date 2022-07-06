<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventDatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventDatesTable Test Case
 */
class EventDatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventDatesTable|\Cake\ORM\Table
     */
    protected $EventDates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.EventDates',
        'app.Events',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EventDates') ? [] : ['className' => EventDatesTable::class];
        $this->EventDates = $this->getTableLocator()->get('EventDates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EventDates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EventDatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EventDatesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
