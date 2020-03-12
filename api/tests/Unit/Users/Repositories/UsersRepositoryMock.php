<?php

namespace Tests\Unit\Domain\Users\Repositories;

use Docuco\Domain\Users\Collections\UserCollection;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\Repositories\UsersRepository;

class UsersRepositoryMock implements UsersRepository
{
  private $users = [];

  public function add_user(User $user, int $user_group_id = -1)
  {
    $this->users[$user_group_id][$user->id] = $user;
  }

  public function get_one_user_by_user_group_id(int $user_group_id, int $user_id): ?User
  {
    if (isset($this->users[$user_group_id])) {
      return $this->users[$user_group_id][$user_id];
    }

    return null;
  }

  public function get_all_users_by_user_group_id(int $user_group_id): UserCollection
  {
    $user_collection = new UserCollection();
    if (isset($this->users[$user_group_id])) {
      foreach ($this->users[$user_group_id] as $user_id => $user) {
        $user_collection->add(new User(
          $user->id,
          $user->name,
          $user->email,
          $user->user_group,
          $user->role
        ));
      }
    }

    return $user_collection;
  }
}
