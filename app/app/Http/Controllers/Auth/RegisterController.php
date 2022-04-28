<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Library\CommonSystem;
use Carbon\Carbon;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  // protected $redirectTo = RouteServiceProvider::HOME;
  protected $redirectTo = "/registed";

  /* limit time */
  protected $limit_time = 30; // minuts

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $t = CommonSystem::test();
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    /* 有効期間の設定 */
    $email_token_limit_at = $this->datetime_plus();

    /* トークン */
    $email_token = $this->issue_email_token($email_token_limit_at);

    /* メール送信 */



    /* DB登録 */
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'status' => 10,
      'email_token' => $email_token,
      'email_token_limit_at' => $email_token_limit_at,
    ]);
  }

  public function datetime_plus()
  {
    /* 現在時間の取得 */
    $carbon = new Carbon();
    $carbon = Carbon::now(); // 現在時刻
    $limit_datetime = $carbon->addMinutes($this->limit_time)->format('Y-m-d H:i:s');
    return $limit_datetime;
  }

  public function issue_email_token(string $datetime)
  {
    $token = hash('sha512',$datetime);
    return $token;
  }
}
