<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Collections\UserCollection;
use Docuco\Domain\Users\Repositories\UsersRepository;

class GetAllUsersAction
{
    private $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id): UserCollection
    {
        return $this->repository->get_all_users_by_user_group_id($user_group_id);
    }
}
