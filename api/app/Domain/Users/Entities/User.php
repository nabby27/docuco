<?php

namespace Docuco\Domain\Users\Entities;

class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $users_group_id;
    public $created_at;
    public $updated_at;

    public function __construct(array $attributes = [])
    {
        foreach ($this as $property => $value) {
            $this->$property = $attributes[$property];
        }
    }
}
