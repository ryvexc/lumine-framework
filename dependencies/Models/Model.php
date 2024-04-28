<?php

namespace Dependencies\Models;

use AllowDynamicProperties;
use Dependencies\Databases\Database;

#[AllowDynamicProperties]
class Model
{
  protected $table = "";
  private $queryStack = "";
  private $whereStack = "";
  private $useWhere = false;
  private $data;

  public function __construct()
  {
    $this->queryStack = "SELECT * FROM $this->table ";
  }

  public function where(string $column, string $value)
  {
    if ($this->useWhere)
      $this->whereStack .= " AND $column = '$value'";
    else
      $this->whereStack .= " WHERE $column = '$value'";

    $_ = new self;
    $_->useWhere = true;
    $_->table = $this->table;
    $_->queryStack = $this->queryStack;
    $_->whereStack = $this->whereStack;

    return $_;
  }

  public function delete()
  {
    Database::execute("DELETE FROM $this->table " . $this->whereStack, false);
  }

  public function get()
  {
    $_ = Database::execute($this->queryStack . $this->whereStack);

    for ($i = 0; $i < count($_); $i++) {
      $data_keys = array_keys($_[$i]);
      $this->data[] = (object) [];

      foreach ($data_keys as $key) {
        $this->data[$i]->$key = $_[$i][$key];
      }
    }

    return $this->data;
  }

  public function create(mixed $data)
  {
    $query = "INSERT INTO $this->table (" . join(",", array_keys($data)) . ") VALUES ('" . join("','", $data) . "')";

    $_keys = array_keys($data);
    $_ = new self;
    for ($i = 0; $i < count($_keys); $i++) {
      $_->{$_keys[$i]} = $data[$_keys[$i]];
    }

    $_->id = Database::execute($query, false)->id;
    return $_;
  }

  public function update(mixed $data)
  {
    $updateStack = [];

    $_keys = array_keys($data);
    for ($i = 0; $i < count($_keys); $i++) {
      $updateStack[] = $_keys[$i] . " = '" . $data[$_keys[$i]] . "'";
    }

    Database::execute("UPDATE $this->table SET " . join(", ", $updateStack) . " " . $this->whereStack, false);

    $_ = new self;
    for ($i = 0; $i < count($_keys); $i++) {
      $_->{$_keys[$i]} = $data[$_keys[$i]];
    }
    return $_;
  }
}
