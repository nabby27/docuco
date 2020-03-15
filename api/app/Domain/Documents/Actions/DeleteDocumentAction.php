<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;

class DeleteDocumentAction
{
    private $documents_repository;

    public function __construct(DocumentsRepository $documents_repository)
    {
        $this->documents_repository = $documents_repository;
    }

    public function execute(int $user_group_id, int $document_id): bool
    {
        return $this->documents_repository->delete_document_by_user_group_id($user_group_id, $document_id);
    }
}
