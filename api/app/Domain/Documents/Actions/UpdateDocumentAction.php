<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\Document;

class UpdateDocumentAction
{
    private $documents_repository;

    public function __construct(DocumentsRepository $documents_repository)
    {
        $this->documents_repository = $documents_repository;
    }

    public function execute(int $users_group_id, $document_to_update): ?Document
    {
        return $this->documents_repository->update_document_by_users_group_id($users_group_id, $document_to_update);
    }
}
