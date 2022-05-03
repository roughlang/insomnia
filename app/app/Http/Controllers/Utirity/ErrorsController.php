<?php

namespace App\Http\Controllers\Utirity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{
  /**
   * url: /errors/503
   */
  public function errors($code)
  {
    /**
     * 401.blade.php
     * 403.blade.php
     * 404.blade.php
     * 419.blade.php
     * 429.blade.php
     * 500.blade.php
     * 503.blade.php
     */
    // dd($code);
    abort($code);
    return true;
  }
}
