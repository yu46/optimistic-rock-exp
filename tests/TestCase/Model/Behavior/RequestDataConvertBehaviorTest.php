<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\RequestDataConvertBehavior;
use Cake\TestSuite\TestCase;
use Cake\Validation\Validation;

/**
 * App\Model\Behavior\EventSystemBehavior Test Case
 */
class RequestDataConvertBehaviorTest extends TestCase
{
    /**
     * fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Events',
        'app.EventDates',
    ];

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\RequestDataConvertBehavior
     */
    protected RequestDataConvertBehavior $RequestDataConvert;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $table = $this->getTableLocator()->get('EventDates');
        $this->RequestDataConvert = new RequestDataConvertBehavior($table, [
            'validateMethod' => function ($value) {
                return Validation::date($value);
            },
        ]);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EventSystem);

        parent::tearDown();
    }

    public function testConvertForInsert(): void
    {
        $data = [];
        $actual = $this->RequestDataConvert->convertForInsert($data);
        $expected = [];
        $this->assertSame($expected, $actual);

        $data = [
            'event_dates' => '2022-07-01',
        ];
        $actual = $this->RequestDataConvert->convertForInsert($data);
        $expected = [
            'event_dates' => [
                ['date' => '2022-07-01'],
            ],
        ];
        $this->assertSame($expected, $actual);

        //スペースあり
        $data = [
            'event_dates' => '2022-07-01, 2022-07-02',
        ];
        $actual = $this->RequestDataConvert->convertForInsert($data);
        $expected = [
            'event_dates' => [
                ['date' => '2022-07-01'],
                ['date' => '2022-07-02'],
            ],
        ];
        $this->assertSame($expected, $actual);

        //スペースなし
        $data = [
            'event_dates' => '2022-07-01,2022-07-03',
        ];
        $actual = $this->RequestDataConvert->convertForInsert($data);
        $expected = [
            'event_dates' => [
                ['date' => '2022-07-01'],
                ['date' => '2022-07-03'],
            ],
        ];
        $this->assertSame($expected, $actual);

        //例外
        $this->expectExceptionMessage('引数$requestDataの値が不正です');
        $this->expectException(\Exception::class);
        $data = [
            'event_dates' => 'aa',
        ];
        $this->RequestDataConvert->convertForInsert($data);
    }

    public function testConvertForUpdate(): void
    {
        $data = [];
        $entities = $this->RequestDataConvert
            ->table()
            ->find()
            ->where(['event_id' => 1])
            ->toArray();
        $actual = $this->RequestDataConvert->convertForUpdate($data, $entities);
        $expected = [];
        $this->assertSame($expected, $actual);

        $data = [
            'event_dates' => '2022-07-01',
        ];
        $actual = $this->RequestDataConvert->convertForUpdate($data, $entities);
        $expected = [
            'event_dates' => [
                [
                    'id' => 1,
                    'date' => '2022-07-01',
                ],
            ],
        ];
        $this->assertSame($expected, $actual);

        //スペースあり
        $data = [
            'event_dates' => '2022-07-01, 2022-07-02, 2022-07-03',
        ];
        $actual = $this->RequestDataConvert->convertForUpdate($data, $entities);
        $expected = [
            'event_dates' => [
                [
                    'id' => 1,
                    'date' => '2022-07-01',
                ],
                [
                    'id' => 2,
                    'date' => '2022-07-02',
                ],
                [
                    'date' => '2022-07-03',
                ],
            ],
        ];
        $this->assertSame($expected, $actual);

        //スペースなし
        $data = [
            'event_dates' => '2022-07-01,2022-07-02,2022-07-03',
        ];
        $actual = $this->RequestDataConvert->convertForUpdate($data, $entities);
        $this->assertSame($expected, $actual);

        //例外
        $this->expectExceptionMessage('引数$requestDataの値が不正です');
        $this->expectException(\Exception::class);
        $data = [
            'event_dates' => 'aa',
        ];
        $this->RequestDataConvert->convertForUpdate($data, $entities);
    }

    public function testCreateInsertData(): void
    {
        $data = [
            '2022-07-01',
            '2022-07-02',
        ];
        $actual = $this->RequestDataConvert->createInsertData($data);
        $expected = [
            [
                'date' => '2022-07-01',
            ],
            [
                'date' => '2022-07-02',
            ],
        ];
        $this->assertSame($expected, $actual);
    }

    public function testCreateUpdateData(): void
    {
        $entities = $this->RequestDataConvert
            ->table()
            ->find()
            ->where(['event_id' => 1])
            ->toArray();
        $requestData = [
            '2022-07-01',
            '2022-07-03',
        ];
        $actual = $this->RequestDataConvert->createUpdateData($entities, $requestData);
        $expected = [
            [
                'id' => 1,
                'date' => '2022-07-01',
            ],
            [
                'date' => '2022-07-03',
            ],
        ];
        $this->assertSame($expected, $actual);
    }
}
