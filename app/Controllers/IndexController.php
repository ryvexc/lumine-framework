<?php

namespace App\Controllers;

use Dependencies\Http\Request;

class IndexController extends Controller
{
  public function index(Request $request)
  {
    return view("index");
  }
}
