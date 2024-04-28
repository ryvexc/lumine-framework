<?php
namespace Database\Migrations;

use Dependencies\Databases\Blueprint;
use Dependencies\Databases\Database;

class siswa_Migration
{
  public static function up()
  {
    $blueprint = new Blueprint('siswa');
    $blueprint->id();

    $blueprint->create();
  }

  public static function destroy()
  {
    Database::dropTableIfExists('siswa');
  }
}
