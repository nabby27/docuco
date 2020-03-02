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

    public function get_all_documents_by_users_group_id(int $users_group_id): DocumentCollection
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
    
    public function get_one_document_by_users_group_id(int $users_group_id, int $document_id): ?Document
    {
        $document_model = $this->document_model
            ->whereHas('users_group', function ($query) use ($users_group_id, $document_id) {
                $query->where('users_group_id', $users_group_id);
            })
            ->find($document_id);
        
        if (isset($document_model)) {
            return new Document($document_model->toArray());
        }

        return null;
    }

    public function update_document_by_users_group_id(int $users_group_id, $document): ?Document
    {
       
        // foreach ($document as $property => $value) {
        //     if ($property != 'id') {
        //         $document_model->$property = $value;
        //     }
        // }
        
        // $document_model->save();

        // dd($document_model);
        // if (isset($document_model)) {
        //     return new Document((array) $document);
        // }

        // return null;
    }
}
