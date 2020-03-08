<?php

namespace Docuco\Domain\Documents\Entities;

use Docuco\Domain\Documents\Collections\TypeCollection;
use Docuco\Domain\Documents\Entities\Type;
use Docuco\Models\DocumentModel;
use Docuco\Models\TypeModel;

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
        array $types,
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
        $types = Document::get_type_collection_from_document_model($document_model);
        return new Document(
            $document_model->id,
            $document_model->name,
            $document_model->description,
            $types->all(),
            $document_model->price,
            $document_model->url,
            $document_model->date_of_issue
        );
    }

    private static function get_type_collection_from_document_model(DocumentModel $document_model): TypeCollection
    {
        $type_collection = new TypeCollection();
        foreach ($document_model->documents_types()->get() as $documents_types_model) {
            $type_model = TypeModel::find($documents_types_model->type_id);
            $type_collection->add(Type::get_from_model($type_model));
        }

        return $type_collection;
    }
}
