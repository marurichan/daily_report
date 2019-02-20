# GizLog

## Version

| PHP        | Laravel     | MySQL        | Node         | npm          |
|:----------:|:-----------:|:------------:|:------------:|:------------:|
| 7.1.19     | 5.6.27      | 5.7.22       | >= 10.0.*    | >= 5.6.*     |

## Installation guide
- Dockerの設定ファイルを共有してもらう  
- 任意の場所に作業用ディレクトリを作ってそこに配置  

```shell
docker-compose up -d --build
cd www
git clone このリポジトリのURL
cd gizlog
cp .env.example .env
composer install
```
### .env の編集  

```shell
# DB設定を以下のように編集
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gizlog
DB_USERNAME=root
DB_PASSWORD=

# 以下を追記してください
MAIL_ADDRESSPASS=some_word
MAIL_PRIVILEGES=some_word
ACCESS_RIGHT_ADMIN=100
ACCESS_RIGHT_USER=010
ACCESS_RIGHT_STORE=001
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_FROM_NAME=GizLog
MAIL_FROM_ADDRESS=atsushi0202test@gmail.com
MAIL_USERNAME=atsushi0202test@gmail.com
MAIL_PASSWORD=hwrtwvrqwnvybxlv
MAIL_ENCRYPTION=ssl
MAIL_PRETEND=false
SLACK_KEY=42620444977.353915109553
SLACK_SECRET=7d76080bb20537972e1487621cf9c020
SLACK_REDIRECT_URI=http://localhost/callback
SLACK_API_KEY=xoxp-42620444977-362509122881-400641301381-e88a476b0565405b24d0e1ed3b31a695
```

### migrateとseed  
```shell
docker-compose exec web bash
```
```shell
php artisan migrate --seed
```

### Access URL  
[http://localhost](http://localhost)  


