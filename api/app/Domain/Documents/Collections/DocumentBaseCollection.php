<?php

namespace Docuco\Domain\Documents\Collections;

use Docuco\Domain\Documents\Entities\DocumentBase;

class DocumentBaseCollection
{
    private $documents = [];

    public function add(DocumentBase $document)
    {
        array_push($this->documents, $document);
    }

    public function all()
    {
        return $this->documents;
    }
}
