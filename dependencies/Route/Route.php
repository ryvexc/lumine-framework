<?php

namespace Dependencies\Route;

use Dependencies\Storage\Variable;

class Route
{
  public static function get($route, array $controller)
  {
    $route = ltrim($route, "/");
    $route = rtrim($route, "/");

    Variable::$routes[] = ["name" => $route, "controller" => $controller, "method" => "GET"];
  }

  public static function post($route, array $controller)
  {
    $route = ltrim($route, "/");
    $route = rtrim($route, "/");

    Variable::$routes[] = ["name" => $route, "controller" => $controller, "method" => "POST"];
  }

  public static function put($route, array $controller)
  {
    $route = ltrim($route, "/");
    $route = rtrim($route, "/");

    Variable::$routes[] = ["name" => $route, "controller" => $controller, "method" => "PUT"];
  }

  public static function delete($route, array $controller)
  {
    $route = ltrim($route, "/");
    $route = rtrim($route, "/");

    Variable::$routes[] = ["name" => $route, "controller" => $controller, "method" => "DELETE"];
  }

  public static function resource($route, $controller)
  {
    $route = ltrim($route, "/");
    $route = rtrim($route, "/");

    Variable::$routes[] = ["name" => $route, "controller" => [$controller, "index"], "method" => "GET"];
    Variable::$routes[] = ["name" => $route, "controller" => [$controller, "store"], "method" => "POST"];
    Variable::$routes[] = ["name" => $route, "controller" => [$controller, "update"], "method" => "PUT"];
    Variable::$routes[] = ["name" => $route, "controller" => [$controller, "destroy"], "method" => "DELETE"];
  }
}
