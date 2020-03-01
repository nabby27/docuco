<?php

namespace Docuco\Domain\Users\Entities;

class Base
{
    public $id;
    
    public function __construct(array $attributes = [])
    {
        foreach ($this as $property => $value) {
            $this->$property = $attributes[$property];
        }
    }
}
