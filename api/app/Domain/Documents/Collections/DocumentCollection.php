<?php

namespace Docuco\Domain\Documents\Collections;

use Docuco\Domain\Documents\Entities\Document;

class DocumentCollection
{
    private $document_collection = [];

    public function add(Document $document)
    {
        $this->document_collection[] = $document;
    }

    public function all()
    {
        return $this->document_collection;
    }
}
