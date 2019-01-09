<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->truncate();
    DB::table('users')->insert([
        [
            'name'          => '坂田 聖史',
            'slack_user_id' => 'AAAAAAAAA',
            'email'         => 'hoge@gmail.com',
            'register_date' => '2017-12-3',
        ],
        [
            'name'          => '安藤 大地',
            'slack_user_id' => 'BBBBBBBBB',
            'email'         => 'fuga@gmail.com',
            'register_date' => '2017-04-3',
        ],
        [
            'name'          => '金谷 翔平',
            'slack_user_id' => 'CCCCCCCCC',
            'email'         => 'foo@gmail.com',
            'register_date' => '2017-07-16',
        ]
    ]);
  }
}

