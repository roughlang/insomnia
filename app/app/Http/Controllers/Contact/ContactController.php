<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Library\CommonSecurity;

/**
 * form
 * confirm
 * send
 * 
 * https://readouble.com/laravel/8.x/ja/validation.html
 */
class ContactController extends Controller
{
  public function __construct()
  {
    // $this->middleware('guest');
  }

  /**
   * contact form
   */
  public function form()
  {
    return view('contact/form');
  }

  /**
   * confirm
   */
  public function confirm(Request $request)
  {
    /* Sanitize */
    $request->name = CommonSecurity::Sanitize($request->name);
    $request->email = CommonSecurity::Sanitize($request->email);
    $request->inquiry_text = CommonSecurity::Sanitize($request->inquiry_text);
    $request->category = CommonSecurity::Sanitize($request->category);
    $request->agreement = CommonSecurity::Sanitize($request->agreement);


    $validated = $request->validate([
      "name" => "required | string | between:3,190",
      "email" => "required|email",
      "inquiry_text" => "required | string | between:10,1200",
      "category" => "required | string",
      "agreement" => 'required',
    ],[
      "name.required" => "お名前を入力してください。",
      "name.string" => "文字を入力してください。",
      "email.required" => "Emailを入力してください。",
      "email.email" => "有効なEmailアドレスを入力してください。",
      "inquiry_text.required" => "お問い合わせ内容を入力してください。",
      "inquiry_text.string" => "文字を入力してください。",
      "inquiry_text.between" => "10文字以上、1200文字以内で入力してください。",
      "category.required" => "お問い合わせの種類を選択してください。",
      "category.string" => "文字列以外のものが入力されています。",
      "agreement.required" => "利用規約に同意してください。",
    ]);

    /* session save */
    $request->session()->put("name", $request->name);
    $request->session()->put("email", $request->email);
    $request->session()->put("inquiry_text", $request->inquiry_text);
    $request->session()->put("category", $request->category);

    return view('contact/confirm')->with([
      "name" => $request->name,
      "email" => $request->email,
      "inquiry_text" => $request->inquiry_text,
      "category" => $request->category,
    ]);
      

  }

  /**
   * send
   */
  public function send(Request $request)
  {
    $mail_message = [
      "subject" => "insomnia お問い合わせありがとうございます。",
      "name" => $request->session()->get("name"),
      "email" =>$request->session()->get("email"),
      "inquiry_text" => $request->session()->get("inquiry_text"),
      "category" => $request->session()->get("category"),
    ];

    /* mail送信 */
    Mail::to($request->session()->get("email"))
      ->bcc("info@roughlang.com","roughlangx@gmail.com")
      ->send( new ContactMail($mail_message)
    );

    /* DB登録 */
    
    $request->session()->flush();
    if ($request->session()->all()) {
      dd("hoge");
    }

    return view('contact/send');
  }
}
