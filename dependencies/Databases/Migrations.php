<?php

namespace Dependencies\Databases;

use ReflectionClass;

class Migrations
{
  public static function GetAllMigrations()
  {
    $classesInNamespace = [];

    foreach (glob('database/migrations/*.php') as $file) {
      include_once $file;

      foreach (get_declared_classes() as $className) {
        $class = new ReflectionClass($className);

        if ($class->inNamespace() && $class->getNamespaceName() === 'Database\Migrations')
          $classesInNamespace[] = $className;
      }
    }

    return array_unique($classesInNamespace);
  }

  public static function Migrate($class)
  {
    Database::load(parse_ini_file(".env"));
    $class::destroy();
    $class::up();
    Database::closeConnection();
  }

  public static function dropTables()
  {
    Database::load(parse_ini_file(".env"));
    Database::dropAllTables();
    Database::closeConnection();
  }
}
