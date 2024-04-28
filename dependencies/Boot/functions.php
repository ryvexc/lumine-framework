<?php

use Dependencies\Storage\Variable;

function chargeView(mixed $value)
{
  echo "<pre>" . print_r($value, 1) . "</pre>";
}

function view(string $view_name, mixed $data = [])
{
  return [
    "USE_VIEW_FOR_UI__SECRET" => "AUTHORED BY RYVEXC https://github.com/ryvexc",
    "view" => Variable::$pagesDir . $view_name . ".php",
    "data" => $data
  ];
}
