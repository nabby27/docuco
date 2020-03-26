<?php

namespace Docuco\Domain\Users\Actions;

use Docuco\Domain\Users\Repositories\UsersRepository;

class DeleteUserAction
{
    private $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id, int $user_id): bool
    {
        return $this->repository->delete_user_by_user_group_id($user_group_id, $user_id);
    }
}
