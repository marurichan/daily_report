<?php

use Illuminate\Database\Seeder;

class UserInfosTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('user_infos')->truncate();
    DB::table('user_infos')->insert([
        [
            'name'          => '坂田 聖史',
            'email'         => 'hoge@gmail.com',
            'register_date' => '2017-12-3',
        ],
        [
            'name'          => '安藤 大地',
            'email'         => 'fuga@gmail.com',
            'register_date' => '2017-04-3',
        ],
        [
            'name'          => '金谷 翔平',
            'email'         => 'foo@gmail.com',
            'register_date' => '2017-07-16',
        ]
    ]);
  }

}

