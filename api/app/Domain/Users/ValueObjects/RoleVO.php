<?php

namespace Docuco\Domain\Users\ValueObjects;

use Docuco\Models\RoleModel;

class RoleVO
{
  public $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public static function get_from_model(RoleModel $role_model): RoleVO
  {
    return new RoleVO($role_model->name);
  }
}
