<?php

namespace Docuco\Domain\Users\Entities;

use Docuco\Domain\Users\Entities\Base;

class User extends Base
{
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $users_group_id;
    public $created_at;
    public $updated_at;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
