<?php

namespace Docuco\Domain\Users\Entities;

class UsersGroup
{
    public $id;
    public $name;

    public function __construct(array $attributes = [])
    {
        foreach ($this as $property => $value) {
            $this->$property = $attributes[$property];
        }
    }
}
