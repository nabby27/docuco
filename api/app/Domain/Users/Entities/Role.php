<?php

namespace Docuco\Domain\Users\Entities;

use Docuco\Domain\Users\Entities\Base;

class Role extends Base
{

    public $name;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
