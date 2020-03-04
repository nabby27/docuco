<?php

namespace Docuco\Infrastructure\Repositories\Documents;

use Docuco\Models\DocumentModel;
use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentBaseCollection;
use Docuco\Domain\Documents\Entities\DocumentBase;
use Docuco\Domain\Documents\Entities\Document;
use Docuco\Domain\Documents\Services\GetDocumentService;

class DocumentsRepositoryORM implements DocumentsRepository
{

    private $document_model;

    public function __construct()
    {
        $this->document_model = new DocumentModel();
    }

    public function get_one_document_by_users_group_id(int $users_group_id, int $document_id): ?Document
    {
        $document_model = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id, $document_id) {
                $query->where('users_group_id', $users_group_id);
            })
            ->find($document_id);
        
        if (isset($document_model)) {
            return GetDocumentService::from_model_to_document($document_model);
        }

        return null;
    }

    public function get_all_documents_by_users_group_id(int $users_group_id): DocumentBaseCollection
    {
        $document_model_collection = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id) {
                $query->where('users_group_id', $users_group_id);
            })
            ->get();

        $document_collection = new DocumentBaseCollection();
        foreach ($document_model_collection as $document_model) {
            $document_collection->add(new DocumentBase($document_model->toArray()));
        }

        return $document_collection;
    }

    public function create_document_by_users_group_id(int $users_group_id, $document_to_create): ?DocumentBase
    {
        $this->document_model->users_group_id = $users_group_id;
        foreach ($document_to_create as $property => $value) {
            if ($property != 'id') {
                $this->document_model->$property = $value;
            }
        }

        $this->document_model->save();
        $document_created = $this->document_model->latest()->first();

        return new DocumentBase($document_created->toArray());
    }

    public function update_document_by_users_group_id(int $users_group_id, $document): ?DocumentBase
    {
        $document_model = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id, $document) {
                $query->where('users_group_id', $users_group_id);
            })
            ->find($document->id);

        if (isset($document_model)) {
            foreach ($document as $property => $value) {
                if ($property != 'id') {
                    $document_model->$property = $value;
                }
            }
            $is_updated = $document_model->save();
            if ($is_updated) {
                return new DocumentBase((array) $document);
            }
        }

        return null;
    }

    public function delete_document_by_users_group_id(int $users_group_id, int $document_id): bool
    {
        $document_model = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id, $document_id) {
                $query->where('users_group_id', $users_group_id);
            })
            ->find($document_id);

        if (isset($document_model)) {
            $is_deleted = $document_model->delete();
            return $is_deleted;
        }

        return false;
    }
}
