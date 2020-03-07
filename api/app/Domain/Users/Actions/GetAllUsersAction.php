<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Collections\UserCollection;
use Docuco\Domain\Users\Repositories\UsersRepository;

class GetAllUsersAction
{
    private $users_repository;

    public function __construct(UsersRepository $users_repository)
    {
        $this->users_repository = $users_repository;
    }

    public function execute(int $user_group_id): UserCollection
    {
        return $this->users_repository->get_all_users_by_user_group_id($user_group_id);
    }
}
