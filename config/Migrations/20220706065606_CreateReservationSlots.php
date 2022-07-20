<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateReservationSlots extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('reservation_slots');
        $table->addColumn('max', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
            'comment' => '最大数',
        ]);
        $table->addColumn('remaining', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
            'comment' => '残数',
        ]);
        $table->addColumn('time_from', 'time', [
            'default' => null,
            'null' => false,
            'comment' => '開始時間',
        ]);
        $table->addColumn('time_to', 'time', [
            'default' => null,
            'null' => false,
            'comment' => '終了時間',
        ]);
        $table->addColumn('version', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
            'comment' => 'ロックバージョン',
        ]);
        $table->addColumn('event_date_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
