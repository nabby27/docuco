<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;

class DeleteDocumentAction
{
    private $repository;

    public function __construct(DocumentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id, int $document_id): bool
    {
        return $this->repository->delete_document_by_user_group_id($user_group_id, $document_id);
    }
}
