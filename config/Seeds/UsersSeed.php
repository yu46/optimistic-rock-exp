<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'username' => 'taro',
                'email' => 'nasu@ekzm.co.jp',
                'password' => '$2y$10$7AjXwLtok.Zd.U1359DYTesjbJxlpqvvwrxI5gGk5vRzJzcxh8bbe',
                'created' =>
                Cake\I18n\FrozenTime::__set_state([
                'date' => '2022-06-29 18:06:08.000000',
                'timezone_type' => 3,
                'timezone' => 'Asia/Tokyo',
                ]),
                'modified' =>
                Cake\I18n\FrozenTime::__set_state([
                'date' => '2022-06-29 18:06:08.000000',
                'timezone_type' => 3,
                'timezone' => 'Asia/Tokyo',
                ]),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
