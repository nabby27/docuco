<?php

namespace Docuco\Domain\Documents\Entities;

class Document extends DocumentBase
{
    public $types;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
