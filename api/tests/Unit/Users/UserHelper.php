<?php

namespace Tests\Unit\Helpers;

use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Domain\Users\Entities\User;

class UserHelper
{
  public static function get_random_user($id, $user_group): User
  {
    return new User(
      $id,
      'example_name',
      'example_email',
      $user_group,
      RoleConstants::VIEW
    );
  }
}
