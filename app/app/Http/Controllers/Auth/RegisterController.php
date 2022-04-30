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

use Illuminate\Support\Facades\Mail;
use App\Mail\TmpRegistMail;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
  // use RedirectsUsers;
  
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
  protected $limit_time = 1440; // minuts 24hour

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
    $access_url = config('app.url')."/registed/pdt/".$email_token;

    /* メール送信 */
    $mail_message = [
      "subject" => "insomniaの仮登録が完了しました",
      "user_name" => $data['name'],
      "access_url" => $access_url,
    ];
    
    Mail::to($data['email'])->send( new TmpRegistMail($mail_message) );

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

  /**
   * app/vendor/laravel/ui/auth-backend/RegistersUsers.phpのコピー
   * traitを継承してここで上書きしています。
   */
  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    /* 登録後の自動ログインを無効にする */
    // $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
        return $response;
    }

    return $request->wantsJson()
      ? new JsonResponse([], 201)
      : redirect($this->redirectPath());
  }

  /**
   * 本登録
   */
  public function registed_pdt($id)
  {
    /**
     * validation
     */
    $count = strlen($id);
    if ($count != 128 && !preg_match("/[0-9][a-z]/",$id)) {
      return redirect('/');
    }

    /* status check */
    $user = User::where('email_token', '=', $id)->first();

    /* user情報はあるか */
    if ($user) {
      $now = Carbon::now();
      $email_token_limit_at = new Carbon($user->email_token_limit_at);
  
      /* 現在時間はLimit以内か */
      if($email_token_limit_at->gt($now)) {
        if($user->status == 10) {
          $user->status = "50";
          $user->email_token = "";
          $user->save();
          return redirect('/login');
        } else {
          return redirect('/');
        }
      } else {
        /**
         * Limitを過ぎている場合は退会にする
         * Emailアドレスはユニークなため、バックアップして伏せ字にする
         */
        Log::channel('user_manage')->info('registed/pdt/{id}: '.$user->id.' '.$user->name.' '.$user->email.' registration deadline has already passed.');
        $user->status = "100";
        $user->email = "";
        $user->email_token = "";
        $user->save();
        return redirect('/');
      }
    } else {
      return redirect('/');
    }
  }

}




