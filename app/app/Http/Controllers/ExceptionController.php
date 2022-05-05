<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExceptionController extends Controller
{
  public function index(Request $request)
  {
    // dd($request->error);
    /**
     * Product(ショップメンバー)の登録を行っていない。
     */
    if($request->error == "none_product_authorization") {
      $message = "ショップメンバーの登録を行ってください。";
      $detail = "";
    }
    return view('exception')->with([
      "message" => $message,
      "detail" => $detail,
    ]);
  }
}

/**
 * authorized error
 * error: none_product_authorization
 */