<?php

namespace Docuco\Domain\Documents\Collections;

use Docuco\Domain\Documents\Entities\Tag; // TODO: change to VO

class TagCollection
{
  private $tags = [];

  public function add(Tag $tags)
  {
    array_push($this->tags, $tags);
  }

  public function all()
  {
    return $this->tags;
  }
}
