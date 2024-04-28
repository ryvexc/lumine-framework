<?php

namespace Dependencies\Http;

class Response
{
  public static function json(mixed $data, int $status_code = 200)
  {
    return [
      "data" => $data,
      "status_code" => $status_code,
      "USE_JSON_FOR_UI__SECRET" => "AUTHORED BY RYVEXC https://github.com/ryvexc"
    ];
  }
}
