<?php

namespace Dependencies\Databases;

class Blueprint
{
  private $table_name = "";
  private $queryString = "";
  private $fields = [];

  public function __construct($table_name)
  {
    $this->table_name = $table_name;
  }

  public function string(string $field_name, int $length = 255)
  {
    $this->fields[] = "$field_name VARCHAR($length)";
  }

  public function id(bool $zerofill = false, int $length = 20,)
  {
    $this->fields[] = "id INT($length) AUTO_INCREMENT " . ($zerofill ? "UNSIGNED ZEROFILL" : "" . "PRIMARY KEY");
  }

  public function create()
  {
    $this->queryString = "CREATE TABLE $this->table_name (
      " . join(", ", $this->fields) . "
    )";

    Database::execute($this->queryString, false);
  }
}
