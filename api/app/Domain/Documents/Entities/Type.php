<?php

namespace Docuco\Domain\Documents\Entities;

use Docuco\Domain\Shared\Entities\Base;
use Docuco\Models\TypeModel;

class Type extends Base
{

    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }

    public static function get_from_model(TypeModel $type_model): Type
    {
        return new Type($type_model->id, $type_model->name);
    }
}
