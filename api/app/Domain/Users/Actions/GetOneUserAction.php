<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Repositories\UsersRepository;
use Docuco\Domain\Users\Entities\User;

class GetOneUserAction
{
    private $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id, int $user_id): ?User
    {
        return $this->repository->get_one_user_by_user_group_id($user_group_id, $user_id);
    }
}
