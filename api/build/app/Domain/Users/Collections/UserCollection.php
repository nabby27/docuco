<?php

namespace Docuco\Domain\Users\Collections;

use Docuco\Domain\Users\Entities\User;

class UserCollection
{
    private $user_collection = [];

    public function add(User $user)
    {
        array_push($this->user_collection, $user);
    }

    public function all()
    {
        return $this->user_collection;
    }
}
