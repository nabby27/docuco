<?php

namespace Docuco\Infrastructure\Repositories\Documents;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Models\DocumentModel;
use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;

class DocumentsRepositoryORM implements DocumentsRepository
{

    private $document_model;

    public function __construct()
    {
        $this->document_model = new DocumentModel();
    }

    public function get_documents_by_users_group_id(int $users_group_id): DocumentCollection
    {
        $document_model_collection = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id) {
                $query->where('users_group_id', $users_group_id);
            })
            ->get();

        $document_collection = new DocumentCollection();
        foreach ($document_model_collection as $document_model) {
            $document_collection->add(new Document($document_model->toArray()));
        }

        return $document_collection;
    }

}
