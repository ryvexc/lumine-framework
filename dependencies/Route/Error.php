<?php

namespace Dependencies\Route;

class Error
{
  public static function json(mixed $reason, $status_code = 400)
  {
    http_response_code($status_code);
    header("Content-Type: application/json");

    echo json_encode([
      "status" => "400",
      "reason" => $reason
    ]);

    die();
  }
}
