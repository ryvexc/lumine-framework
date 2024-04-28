<?php

namespace Dependencies\Databases;

use Dependencies\Route\Error;
use Dependencies\Storage\Variable;
use mysqli_sql_exception;

class Database
{
  public static $env = "";

  public static function load($env)
  {
    self::$env = $env;

    try {
      $connection = mysqli_connect($env["DB_HOST"], $env["DB_USERNAME"], $env["DB_PASSWORD"], $env["DB_NAME"], $env["DB_PORT"]);
      Variable::$connection = $connection;
    } catch (mysqli_sql_exception $e) {
      Error::json($e->getMessage(), 400);
    }
  }

  public static function dropAllTables()
  {
    $tables = self::execute("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema='" . self::$env["DB_NAME"] . "'");

    foreach ($tables as $table) {
      self::execute("DROP TABLE " . $table["TABLE_NAME"], false);
    }
  }

  public static function dropTableIfExists($table_name)
  {
    self::execute("DROP TABLE IF EXISTS $table_name", false);
  }

  public static function execute(string $query, bool $with_result = true)
  {
    $data = [];
    $query = mysqli_query(Variable::$connection, $query);

    if ($with_result) {
      while ($_ = mysqli_fetch_assoc($query)) $data[] = $_;
      return $data;
    } else if ($query) {
      return (object)["id" => mysqli_insert_id(Variable::$connection)];
    }
  }

  public static function closeConnection()
  {
    Variable::$connection = null;
  }
}
