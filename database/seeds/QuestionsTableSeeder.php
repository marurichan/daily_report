<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id'         => 2,
                'tag_category_id' => 2,
                'title'           => 'SQLのJOINについて',
                'content'         => '勤怠管理ページを作っており
    a_m.phpで「出勤」「退勤」「休憩開始」「休憩終了」をラジオボタンで選択し
    a_ma.phpでデータベースに保存しています。
    name=NoでスタッフNoを、name=officeで勤怠を、date関数で出した時間をそれぞれ
    データベース内に保存しています。
    
    今回、そこから日当を計算したいので
    データベース内の該当スタッフNoの出勤~退勤の時間の差分を割り出し
    時給を掛けて表示をさせたいと思っております。',
                'created_at'      => '2017-12-3',
            ],
            [
                'user_id'         => 2,
                'tag_category_id' => 1,
                'title'           => 'divの中央寄せのやり方がわかりません',
                'content'         => 'ツイートのボタンを左寄せにしたいと考えています。
    
    ですが現状headerが途中から始まってしまっている状態です。
    
    また、現在Bootstrapで行おうとしてるのですがなかなかうまくいきません。
    他に良い方法はございますでしょうか？
    
    よろしくお願いいたします。
    
    （bodyをoffsetしてるのでheaderもつられて途中から始まっているのでしょうか？）
    
    ',
                'created_at'      => '2018-10-9',
            ],
            [
                'user_id'         => 2,
                'tag_category_id' => 3,
                'title'           => 'AWSでEC2のインスタンスがうまくたてられない',
                'content'         => '所在が不明なインスタンスがあります。
    
    cloudwatchでアラームを作っていたのですが、
    メトリックス->EC2->インスタンス別メトリックスで一覧を見ると、インスタンスが一つある状態になっています。
    
    現在、東京リージョンで作業をしているのですが、特にEC2インスタンス一覧にはインスタンスが表示されていません。
    接続時に、リージョンが米国に変わっていた事もあったので、念のため確認して見ましたがインスタンスが残っていません。
    
    現状インスタンスのID（i-xxxxxxxxxxの形式の情報）しかわからないのですが、所在を確認するにはどうしたらよいでしょうか？',
                'created_at'      => '2017-08-20',
            ],
            [
                'user_id'         => 2,
                'tag_category_id' => 2,
                'title'           => 'Unknown valiableと表示されてしまいます',
                'content'         => '初期表示では、エラーが出ませんが、ajaxで送信した後に下記のようなエラーが出るので解消したいです。
    Fatal error: Uncaught Error: Class DirectChat not found in /var/www/html/xxxxx.xyz/xxx-groupwork_ushijima/library/Api/chatDirect.php:10 Stack trace: #0 {main} thrown in /var/www/html/xxxxx.xyz/xxx-groupwork_ushijima/library/Api/chatDirect.php on line 10',
                'created_at'      => '2018-10-9',
            ],
        ]);
    }
}

