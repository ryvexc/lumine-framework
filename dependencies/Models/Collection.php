<?php

namespace Dependencies\Models;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class Collection
{
  public function __construct(string $key, mixed $value)
  {
    $this->$key = $value;
  }
}
