<?php

namespace Docuco\Domain\Users\Entities;

use Docuco\Domain\Shared\Entities\Base;
use Docuco\Models\UserGroupModel;

class UserGroup extends Base
{

    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }

    public static function get_from_model(UserGroupModel $user_group_model): UserGroup
    {
        return new UserGroup($user_group_model->id, $user_group_model->name);
    }
}
