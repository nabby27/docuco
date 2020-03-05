<?php

namespace Docuco\Domain\Users\Entities;

use Docuco\Domain\Users\ValueObjects\UserGroupVO;
use Docuco\Domain\Users\ValueObjects\RoleVO;

class User
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $user_group;

    public function __construct(
        int $id,
        string $name,
        string $email,
        UserGroupVO $user_group,
        RoleVO $role
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->user_group = $user_group;
    }
}
