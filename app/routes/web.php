<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Library\CommonSecurity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('index'); });

/**
 * blog
 */
Route::get('/blog', function () { return view('blog/index'); });
Route::get('/blog/post/{id}', function ($id) { return view('blog/post',['id'=>$id]); });
Route::get('/blog/archives', function () { return view('blog/archives'); });
Route::get('/blog/gallery', function () { return view('blog/gallery'); });


/* utility */
if (env('APP_ENV') == 'local' || env('APP_ENV') == 'develop' || env('APP_ENV') == 'stging') {
  /* phpmyadmin */
  Route::get('/phpinfo', function () { return view('phpinfo'); });
  /* error */
  Route::get('/errors/{code}', [App\Http\Controllers\Utirity\ErrorsController::class, 'errors']);
}

/**
 * contact
 */
Route::get('/contact', [App\Http\Controllers\Contact\ContactController::class, 'form'])->name('contact');
Route::post('/contact/confirm', [App\Http\Controllers\Contact\ContactController::class, 'confirm']);
Route::post('/contact/send', [App\Http\Controllers\Contact\ContactController::class, 'send']);

/**
 * test
 */
Route::get('/test/vueajax', [App\Http\Controllers\VueajaxController::class, 'index'])->name('vueajax');

/**
 * vue
 */
Route::get('/vue', function () { return view('vue/index'); });
Route::get('/vue/ajax_get', function () { return view('vue/ajax_get'); });
Route::get('/vue/component', function () { return view('vue/component'); });


/**
 * Login
 */
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Register
 */
Route::get('/registed', function () { return view('register/registed'); });
Route::get('/registed/pdt/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'registed_pdt']);

/**
 * Home
 */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/member/account', [App\Http\Controllers\Member\AccountController::class, 'index'])->name('member_account');



/**
 * admin
 * https://www.milk-island.net/javascript/hashgenerator/sha2_512.html
 */
Route::get('/7f112c5bc568/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('adminroot');
// Route::get('/acd79785b292/{slug}', [App\Http\Controllers\Admin\AdminController::class, 'uploader'])->name('uploader');
Route::get('/acd79785b292/uploader', [App\Http\Controllers\Admin\UploadController::class, 'uploader'])->name('uploader');
Route::post('/978ccf1b305a12920150275cb6ad5a1746932720/save', [App\Http\Controllers\Admin\UploadController::class, 'save'])->name('upload_save');



