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
                'user_id'     => 2,
                'question_id' => 1,
                'comment'     => '質問コメントテスト',
                'created_at'  => '2018-12-3',
            ],
            [
                'user_id'     => 2,
                'question_id' => 1,
                'comment'     => '上記のカラムタイプに付け加え、カラムを追加するときに使用できる様々な修飾子もあります。たとえばカラムを「NULL値設定可能(nullable)」にしたい場合は、nullableメソッドを使います。',
                'created_at'  => '2018-12-1',
            ]
        ]);
    }
}

