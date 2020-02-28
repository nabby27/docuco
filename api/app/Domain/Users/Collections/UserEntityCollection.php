<?php

namespace Docuco\Domain\Users\Collections;

use Docuco\Domain\Users\Entities\UserEntity;

class UserEntityCollection
{
    private $userEntityCollection = [];

    public function add(UserEntity $userEntity)
    {
        $this->userEntityCollection[] = $userEntity;
    }

    public function all()
    {
        return $this->userEntityCollection;
    }
}
