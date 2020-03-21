<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Repositories\UsersRepository;
use Docuco\Domain\Users\Entities\User;

class CreateUserAction
{
  private $users_repository;

  public function __construct(UsersRepository $users_repository)
  {
    $this->users_repository = $users_repository;
  }

  public function execute(int $user_group_id, $user): ?User
  {
    return $this->users_repository->create_user_by_user_group_id($user_group_id, $user);
  }
}
