<?php

namespace Docuco\Domain\Documents\Entities;

use Docuco\Models\DocumentModel;
use Docuco\Models\TagModel;

class Document
{
    public $id;
    public $name;
    public $description;
    public $tags;
    public $type;
    public $price;
    public $url;
    public $date_of_issue;

    public function __construct(
        int $id,
        string $name,
        string $description,
        array $tags,
        string $type,
        float $price,
        string $url,
        string $date_of_issue
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->tags = $tags;
        $this->type = $type;
        $this->price = $price;
        $this->url = $url;
        $this->date_of_issue = $date_of_issue;
    }

    public static function get_from_model(DocumentModel $document_model): Document
    {
        $tags = Document::get_tag_collection_from_document_model($document_model);
        $type = Document::get_type_from_document_model($document_model);
        return new Document(
            $document_model->id,
            $document_model->name,
            $document_model->description,
            $tags,
            $type,
            $document_model->price,
            $document_model->url,
            $document_model->date_of_issue
        );
    }

    private static function get_tag_collection_from_document_model(DocumentModel $document_model): array
    {
        $tags = [];
        foreach ($document_model->documents_tags()->get() as $documents_tags_model) {
            $tag_model = TagModel::find($documents_tags_model->tag_id);
            array_push($tags, $tag_model->name);
          // $tag_collection->add(Tag::get_from_model($tag_model->name));
        }

        return $tags;
    }

    private static function get_type_from_document_model(DocumentModel $document_model): string
    {
        return $document_model->type()->first()->name;
    }
}
