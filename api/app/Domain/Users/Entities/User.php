<?php

namespace Docuco\Domain\Users\Entities;

use Docuco\Domain\Shared\Entities\Base;
use Docuco\Domain\Users\Entities\UserGroup;
use Docuco\Domain\Users\ValueObjects\RoleVO;
use Docuco\Models\UserModel;

class User extends Base
{
    public $email;
    public $user_group;
    public $role;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $user_group,
        string $role
    ) {
        parent::__construct($id, $name);
        $this->email = $email;
        $this->user_group = $user_group;
        $this->role = $role;
    }

    // public function get()
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'user_group' => $this->user_group->name,
    //         'role' => $this->role->name
    //     ];
    // }

    public static function get_from_model(UserModel $user_model): User
    {
        $user_group = UserGroup::get_from_model($user_model->user_group);
        $role = RoleVO::get_from_model($user_model->role);

        return new User(
            $user_model->id,
            $user_model->name,
            $user_model->email,
            $user_group->name,
            $role->name
        );
    }
}
