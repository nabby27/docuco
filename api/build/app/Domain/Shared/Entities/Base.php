<?php

namespace Docuco\Domain\Shared\Entities;

class Base
{
    public $id;
    public $name;

    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }
}
