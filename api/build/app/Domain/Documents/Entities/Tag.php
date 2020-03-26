<?php

namespace Docuco\Domain\Documents\Entities;

use Docuco\Domain\Shared\Entities\Base;
use Docuco\Models\TagModel;

class Tag extends Base
{

    public function __construct(int $id, string $name)
    {
        parent::__construct($id, $name);
    }

    public static function get_from_model(TagModel $tag_model): Tag
    {
        return new Tag($tag_model->id, $tag_model->name);
    }
}
