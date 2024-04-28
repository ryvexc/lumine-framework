<?php

namespace Dependencies\Http;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Request
{
  private $rawQueries = [];

  public object $get, $post;

  public function __construct()
  {
    $this->get = (object)[];
    $this->post = (object)[];
  }

  public function __set($name, $value)
  {
    $this->$name = $value;
  }

  public function generateFrom(array $queries)
  {
    if (count($queries) <= 0) return;

    $this->rawQueries = $queries;
    $_keys = array_keys($queries);

    for ($i = 0; $i < count($_keys); $i++) {
      $this->{$_keys[$i]} = $queries[$_keys[$i]];
    }
  }

  public function setForPost(array $queries)
  {
    if (count($queries) <= 0) return;

    $this->rawQueries = $queries;
    $_keys = array_keys($queries);

    for ($i = 0; $i < count($_keys); $i++) {
      $this->post->{$_keys[$i]} = $queries[$_keys[$i]];
    }
  }

  public function setForGet(array $queries)
  {
    if (count($queries) <= 0) return;

    $this->rawQueries = $queries;
    $_keys = array_keys($queries);

    for ($i = 0; $i < count($_keys); $i++) {
      $this->get->{$_keys[$i]} = $queries[$_keys[$i]];
    }
  }


  public function all()
  {
    return (object) $this->rawQueries;
  }
}
