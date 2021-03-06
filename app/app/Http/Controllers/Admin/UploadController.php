<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Library\CommonSecurity;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\File;
use App\Image;
use Storage;

class UploadController extends Controller
{
  private $user;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(Request $request)
  {
    $this->middleware('auth');
    
    /* IP制限 */
    if (CommonSecurity::PassByIPAddress() === false) {
      abort( 404 );
    }

    /* Super users */
    $this->middleware(function ($request, $next) {
      $this->user = \Auth::user();
      if (CommonSecurity::PassBySuperUsers($this->user) === false) {
        abort( 404 );
      }
      return $next($request);
    });
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function uploader()
  {
    // var_dump($this->user->email);
    $this->current_ip = \Request::ip();
    Log::channel('admin_access')->info('admin/uploader: '.$this->current_ip);

    return view('admin/uploader');
  }
  /**
   * upload request
   */
  public function save(Request $request)
  {
    $this->current_ip = \Request::ip();
    Log::channel('admin_access')->info('admin/save: '.$this->current_ip." ".$request->file('files'));

    // abort(422);
    $validated = $request->validate([
      'files' => ['nullable','file','image','mimes:jpg,jpeg,png,bmp,gif,svg,webp','dimensions:min_width=50,min_height=50,max_width=5000,max_height=5000'],
      // 'files' => ['image','mimes:jpg'],
    ],[
      'files.image' => 'jpg,jpeg,png,bmp,gif,svg,webp以外の拡張子は利用できません。',
      'files.dimensions' => '縦横5000px以下のサイズでアップロードしてください。',
    ]);

    /**
     * get files
     */
    $file = $request->file('files');
    $originalName = $file->getClientOriginalName();
    
    // dd($request);
    // dd($request);
    // $file = $request->file('a');
    // // var_dump($file);
    // date_default_timezone_set('Asia/Tokyo');
    // /* get file name */
    // $originalName = $file->getClientOriginalName();
    // $micro = explode(" ", microtime());
    $dir = 'public';
    $file->storeAs($dir, $originalName, ['disk' => 'local']);
    
    Log::channel('admin_access')->info('admin/save: '.$this->current_ip.' uploaded success.');
    return $originalName;
  }
}
