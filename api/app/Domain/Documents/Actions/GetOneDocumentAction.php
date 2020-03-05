<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\Document;

class GetOneDocumentAction
{
    private $documents_repository;

    public function __construct(DocumentsRepository $documents_repository)
    {
        $this->documents_repository = $documents_repository;
    }

    public function execute(int $user_group_id, int $document_id): ?Document
    {
        return $this->documents_repository->get_one_document_by_user_group_id($user_group_id, $document_id);
    }
}
