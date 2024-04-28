<?php

use Dependencies\Storage\Variable;
use Dependencies\Databases\Database;
use Dependencies\Http\Request;

Database::load(parse_ini_file(".env"));

include "routes/route.php";
include "dependencies/Boot/functions.php";

$route_find_success = 0;
$request_route = parse_url(isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'])["path"];

foreach (Variable::$routes as $route) {
  if ($request_route == "/" . $route["name"] && $_SERVER["REQUEST_METHOD"] == $route["method"]) {
    $request = new Request();
    $request->generateFrom($_GET, "get");
    $request->generateFrom($_POST, "post");

    $result = (new $route["controller"][0])->{$route["controller"][1]}($request);
    if (isset($result["USE_VIEW_FOR_UI__SECRET"])) require $result["view"];
    else if (isset($result["USE_JSON_FOR_UI__SECRET"])) {
      http_response_code($result["status_code"]);
      header("Content-Type: application/json", true, $result["status_code"]);
      echo json_encode($result["data"], JSON_PRETTY_PRINT);
    }

    $route_find_success++;
  }
}

if ($route_find_success == 0) {
  http_response_code(404);
  require "dependencies/Route/404.php";
}
