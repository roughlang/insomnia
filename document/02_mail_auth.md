# Mail認証

summary: Laravelのデフォルトの認証機能にはメール認証やSNS認証などの本人確認のフローが実装されていない。誰でも無限に登録できるようになっているので、本人確認の上で登録できる仕組みをつくならなければならない。最初の登録を仮登録として、メール認証後を本登録とするフローにする。

[laravelでメールアドレス認証の仕組みを作ってみた](https://qiita.com/yu7a21/items/cc4dc9b9eb78d87f5086)  
https://reffect.co.jp/laravel/laravel-authentication-understand


## Spec

#### 1. メールアドレス・パスワードを入力

UIは通常のものをそのまま使って登録。登録時に仮登録である状態がわかるフラグを作成する。DBカラムの追加と状態の正規化。

| no | status | text | description |
| --- | ------ | ---- |  ----------- |
| 10 | 仮登録  | Temporary registration |  トークンを発行とメールの送信 |
| 50 | 本登録  | registrated |  メールの中のURLをクリックし、該当トークンのユーザーを登録する |

当時にトークンとトークンの有効期限を発行する。トークンの発行期限はデフォルトで30分以内。
なので、保存するデータは、ステータスナンバー、トークン、トークンの有効期限の３つ。


#### 2. トークンを発行とメールの送信

トークンを使ったURLを作成しユーザーがメールで受信できるようにする。
送信メールの仕組みの作成（Gmailの送信メールサーバーを使う）

#### 3. メールの中のURLをクリックし、該当トークンのユーザーを登録する

メール内の認証トークン付きのURLを受けるページにて本人の認証を行う。  
その際に該当DBのレコードを更新し10から20に変更する。


- usersテーブルに必要カラムの追加。（ステータスナンバー、トークン、トークンの有効期限）
- 本登録を受ける画面の作成（ルーティングとトークンアクセスの処理系）


## Order for source

1. DB migration
2. メールの送信
3. 認証条件を追加する

### 1. DB migration

追加項目（カラム）

- status
- email_token
- email_token_limit_at


```
$ ./vendor/bin/sail artisan make:migration add_mailauth_to_users_table --table=users
```
このファイルに追加カラムを書く。
```
database/migrations/2022_04_26_193207_add_mailauth_to_users_table.php
```


### 2. メールの送信

Gmailの送信メールサーバーを利用する
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.lolipop.jp
MAIL_PORT=465
MAIL_USERNAME=info@roughlang.com
MAIL_PASSWORD=g--6S_6eW_016J6p
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@roughlang.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_PRETEND=true
```

tinker
```
% ./vendor/bin/sail artisan tinker
Psy Shell v0.11.2 (PHP 8.0.14 — cli) by Justin Hileman
>>> Mail::raw('', function($message) { $message->to('roughlangx@gmail.com')->subject('hoge'); });
=> null
```
これでメールの送信はOK


### 3. 認証条件を追加する

https://qiita.com/kd9951/items/748408547331517479a7
