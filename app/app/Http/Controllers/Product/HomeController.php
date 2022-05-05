<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  public $user;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function home()
  {
    /* product members */
    
    $this->user = Auth::user();
    /**
     * normal: 通常メンバー
     * product: shopメンバー
     * premium: 未定
     * buyer: 商品登録・商品販売・バイヤー
     * superadmin: スーバーアドミン
     */
    if ($this->user->member_class == "product"){
      return view('product/home')->with([
        "user" => $this->user,
      ]);
    } else {
      return redirect('exception?error=none_product_authorization');  
    }
  }
}
