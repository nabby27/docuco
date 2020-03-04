<?php

namespace Tests\Unit\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentBaseCollection;
use Docuco\Domain\Documents\Entities\DocumentBase;

class DocumentsRepositoryMock implements DocumentsRepository
{
    private $documents = [];

    public function addDocument(int $document_id, DocumentBase $document)
    {
        $this->documents[$document_id] = $document;
    }

    public function get_all_documents_by_users_group_id(int $users_group_id): DocumentBaseCollection
    {
    }
    
    public function get_one_document_by_users_group_id(int $users_group_id, int $document_id): ?DocumentBase
    {
    }
}
