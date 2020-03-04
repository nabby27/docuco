<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\DocumentBase;

class CreateDocumentAction
{
    private $documents_repository;

    public function __construct(DocumentsRepository $documents_repository)
    {
        $this->documents_repository = $documents_repository;
    }

    public function execute(int $users_group_id, $document_to_create): ?DocumentBase
    {
        return $this->documents_repository->create_document_by_users_group_id($users_group_id, $document_to_create);
    }
}
