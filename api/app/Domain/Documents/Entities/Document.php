<?php

namespace Docuco\Domain\Documents\Entities;

use Docuco\Domain\Documents\Collections\TypeCollection;
use Docuco\Domain\Documents\Entities\Type;
use Docuco\Models\DocumentModel;

class Document
{
    public $id;
    public $name;
    public $description;
    public $types;
    public $price;
    public $url;
    public $date_of_issue;

    public function __construct(
        int $id,
        string $name,
        string $description,
        TypeCollection $types,
        float $price,
        string $url,
        string $date_of_issue
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->types = $types;
        $this->price = $price;
        $this->url = $url;
        $this->date_of_issue = $date_of_issue;
    }

    public static function get_from_model(DocumentModel $document_model): Document
    {
        $types = Document::getTypesFromDocumentModel($document_model);
        return new Document(
            $document_model->id,
            $document_model->name,
            $document_model->description,
            $types,
            $document_model->price,
            $document_model->url,
            $document_model->date_of_issue
        );
    }

    private static function getTypesFromDocumentModel(DocumentModel $document_model): TypeCollection
    {
        $type_collection = new TypeCollection();
        foreach ($document_model->documents_types() as $documents_types_model) {
            // $type_collection->add(new Type(
            //     $documents_types_model->type()->id,
            //     $documents_types_model->type()->name
            // ));
        }

        return $type_collection;
    }
}
