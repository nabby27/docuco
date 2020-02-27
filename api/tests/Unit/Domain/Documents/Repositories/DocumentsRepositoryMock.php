<?php

namespace Tests\Unit\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\Document;

class DocumentsRepositoryMock implements DocumentsRepository
{
    private $documents = [];

    public function addDocument(int $document_id, Document $document)
    {
        $this->documents[$document_id] = $document;
    }
}
