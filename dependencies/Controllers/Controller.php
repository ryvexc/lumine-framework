<?php

namespace Dependencies\Controllers;

use Dependencies\Http\Response;

class Controller
{
  public function ok($data, $status_code = 200)
  {
    return Response::json($data, $status_code);
  }
}
