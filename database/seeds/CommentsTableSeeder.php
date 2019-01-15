<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id'     => 4,
                'question_id' => 1,
                'comment'     => '質問コメントテスト',
                'created_at'  => '2018-12-3',
            ]
        ]);
    }
}

