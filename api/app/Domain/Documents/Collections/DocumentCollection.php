<?php

namespace Docuco\Domain\Documents\Collections;

use Docuco\Domain\Documents\Entities\Document;

class DocumentCollection
{
    private $documents = [];

    public function add(Document $document)
    {
        array_push($this->documents, $document);
    }

    public function all()
    {
        return $this->documents;
    }
}
