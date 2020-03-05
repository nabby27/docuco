<?php

namespace Docuco\Domain\Documents\Collections;

use Docuco\Domain\Documents\Entities\Type;

class TypeCollection
{
    private $types = [];

    // public function add(Type $types)
    // {
    //     array_push($this->types, $types);
    // }

    public function all()
    {
        return $this->types;
    }
}
