<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\Document;

class CreateDocumentAction
{
    private $documents_repository;

    public function __construct(DocumentsRepository $documents_repository)
    {
        $this->documents_repository = $documents_repository;
    }

    public function execute(int $user_group_id, $document_to_create): ?Document
    {
        return $this->documents_repository->create_document_by_user_group_id($user_group_id, $document_to_create);
    }
}
