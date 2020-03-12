<?php

namespace Docuco\Domain\Users\Repositories;

use Docuco\Domain\Users\Collections\UserCollection;
use Docuco\Domain\Users\Entities\User;

interface UsersRepository
{
  public function get_one_user_by_user_group_id(int $user_group_id, int $user_id): ?User;
  public function get_all_users_by_user_group_id(int $user_group_id): UserCollection;
  // public function create_user_by_user_group_id(int $user_group_id, $user_to_create): ?User;
  // public function update_user_by_user_group_id(int $user_group_id, $user_to_update): ?User;
  // public function delete_user_by_user_group_id(int $user_group_id, int $user_id): bool;
}
