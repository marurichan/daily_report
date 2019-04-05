# 課題（日報機能）

## 準備

下記のコマンドを入力してDBを初期化し、課題用のブランチに切り替えましょう。
```shell
php artisan migrate:reset
git stash  # masterブランチで変更した点があれば一度退避させます
git checkout -b lesson_daily_report origin/lesson_daily_report
```

```git branch```と入力して、```lesson_daily_report```に切り替わっていることを確認してください。  
再度GizLogを開くと、日報画面が開けなくなっているはずです。

## 課題内容
キャプチャを元に、ユーザー側と管理者側の日報機能を作成しましょう。  
```view/daily_report/```に静的ページは用意してあります。

#### 一覧画面
<p align="center"><img src="https://res.cloudinary.com/gizumo-inc/image/upload/v1554351080/curriculums/GizLog/%E6%97%A5%E5%A0%B1%E4%B8%80%E8%A6%A7.png"></p>  

#### 作成画面
<p align="center"><img src="https://res.cloudinary.com/gizumo-inc/image/upload/v1554351080/curriculums/GizLog/%E6%97%A5%E5%A0%B1%E4%BD%9C%E6%88%90.png"></p>  

#### 詳細画面
<p align="center"><img src="https://res.cloudinary.com/gizumo-inc/image/upload/v1554351080/curriculums/GizLog/%E6%97%A5%E5%A0%B1%E8%A9%B3%E7%B4%B0.png"></p>

#### 編集画面
<p align="center"><img src="https://res.cloudinary.com/gizumo-inc/image/upload/v1554351080/curriculums/GizLog/%E6%97%A5%E5%A0%B1%E7%B7%A8%E9%9B%86.png"></p>

#### バリデーションエラー時
<p align="center"><img src="https://res.cloudinary.com/gizumo-inc/image/upload/v1554346457/curriculums/GizLog/%E6%97%A5%E5%A0%B1%E6%9C%AA%E5%85%A5%E5%8A%9B.png"></p>


## テーブル構造

下記の内容のテーブルを作成しましょう。

テーブル名：daily_report  

|column名|説明|
|:-----|:-----|
|user_id|日報の投稿者|
|title|日報のタイトル|
|contents|日報の内容|
|reporting_time|日報の日付|
|created_at|登録日時|
|updated_at|更新日時|
|deleted_at|削除日時|