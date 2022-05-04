<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SerializerController extends Controller
{
  public function serializer()
  {
    return view('tools/serializer');
  }

  public function serialized(Request $request)
  {
    $validated = $request->validate([
      "text" => "required | string"
    ],[
      "text.required" => "必須項目です",
      "text.string" => "文字列を送信してください。",
    ]);
    
    $array = json_decode($request["text"]);
    if (empty($array)) {
      return "jsonの形式が間違っているようです。";
    } else {
      $text = serialize($array);
      Log::debug($text);
      return $text;
    }
   
    
      
    

    
  }
}
