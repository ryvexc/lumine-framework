<?php

namespace Dependencies\Databases;

use ReflectionClass;

class Migrations
{
  public static function GetAllMigrations()
  {
    $namespace = 'Database\Migrations';
    $classesInNamespace = [];

    $migrationFiles = glob('database/migrations/*.php');

    foreach ($migrationFiles as $file) {
      include_once $file;

      $declaredClasses = get_declared_classes();

      foreach ($declaredClasses as $className) {
        $class = new ReflectionClass($className);

        if ($class->inNamespace() && $class->getNamespaceName() === $namespace) {
          $classesInNamespace[] = $className;
        }
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
