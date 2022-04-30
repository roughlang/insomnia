# Interface specification Users

## users table

| name | type | description |
| -- | ------ | ---- |
| id | bigint | 一意に振られたID（オートインクリメント） |
| name | varchar(191) | ユーザーが入力した名前（ニックネーム） |
| email | varchar(191)| ユーザーEmailアドレス |	
| email_verified_at | timestamp| ---- |
| password | varchar(191) | ユーザーの暗号化されたパスワード |
| remember_token | varchar(100) | パスワード紛失時のリセットトークン |
| created_at | timestamp | ユーザーの登録日 |
| updated_at | timestamp | ユーザーのアップデート日 |
| status | smallint | ユーザーの登録ステータス（10:仮登録,50:本登録,90:退会,100:削除・バックアップ済）|
| email_token | varchar(512) | ---- |
