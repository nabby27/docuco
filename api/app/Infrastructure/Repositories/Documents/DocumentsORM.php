<?php

namespace Docuco\Infrastructure\Repositories\Documents;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Models\DocumentModel;

class DocumentsRepositoryORM implements DocumentsRepository
{

    private $documentModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
    }
}
