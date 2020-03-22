<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\Document;

class UpdateDocumentAction
{
    private $repository;

    public function __construct(DocumentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id, $document_to_update): ?Document
    {
        return $this->repository->update_document_by_user_group_id($user_group_id, $document_to_update);
    }
}
