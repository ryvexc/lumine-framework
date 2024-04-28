<?php

namespace App\Controllers;

use Dependencies\Http\Request;
use Dependencies\Http\Response;

class IndexController extends Controller
{
  public function index(Request $request)
  {
    return view("index");
  }
}
