# Laravel authの仕組み

Laravelに認証関連の仕組みはミドル・ウェアで行われています。LaravelのミドルウェアはコントローラとWEBの抽象的なシステムの中間層に位置しているLaravel独特の構造システムです。一連の動作を「認証」といいますが、本来的には「認証」と「認可」に分かれています。

- 認証(Authentication)は、そのユーザが誰かを判断すること
- 認可(Authorization)は、そのユーザで何ができるかを判断すること

この認証と認可の仕組みを説明します。
もっともビジュアル的にわかりやすい認証関連のGUIから見てゆきます。viewのファイルは`resources/views/auth`に格納されています。登録画面、ログイン画面、パスワードリセット、ログイン後のホーム画面のそれぞれの画面です。

```
resources/views/auth
resources/views/auth/passwords/confirm.blade.php
resources/views/auth/passwords/email.blade.php
resources/views/auth/passwords/reset.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/home.blade.php
```


## 登録 - Regist

`/register`にアクセスすると、登録画面にアクセスできます。これらのルーティングを見てみます。ルーティングを調べると、このパスに紐付いたコントローラなどが書かれていないことがわかります。
```
// app/routes/web.php
Auth::routes();
```
と一行書かれているのみなのです。これの実態がどこにあるのかというと、
```
vendor/laravel/ui/auth-backend/RegistersUsers.php
```
このファイルになります。`showRegistrationForm()`メソッドで入力フォームのviewを返していることがわかります。さてこのフォームから入力した内容はどこにPOSTされているのかというと、`/register`にPOSTされています。なのでこのルーティングを探してみようと思いますが、これまたどこにも書かれてません。artisanコマンドを使ってルートを検索してみます。
```
$ ./vendor/bin/sail artisan route:list | grep register
```
同じ`vendor/laravel/ui/auth-backend/RegistersUsers.php`の`register()`メソッドで処理を行っていることがわかりました。やっていることはフォームバリデーション、ユーザーのDB登録、ユーザー情報を取得してガードの生成、その後のリダイレクト処理をしているという感じです。
カスタマイズが必要になった場合にはこのtraitにカスタマイズを加えるのではなく、これらを継承したコントローラをapp/Http/COntrollers/Auth/*以下に作成して、機能を加えたり削除したりします。やり方は簡単で`trait RegistersUsers`のメソッドを使いたいコントローラの中にまるごとコピーします。コピーしたメソッドが優先されて、trait RegistersUsersを上書きする構造になっているのです。修正はコントローラ側で行います。traitをコピーしたときは同時に`use`の内容も取得する必要があります。





```
App\Http\Controllers\Auth\RegisterController@showRegistrationForm
```
で`RegisterController`コントローラの`showRegistrationForm`メソッドが動いていることがわかります。


