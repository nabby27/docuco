<?php

namespace Docuco\Domain\Documents\Services;

use Docuco\Domain\Documents\Entities\Document;
use Docuco\Models\DocumentModel;

class GetDocumentService
{
    public static function from_model_to_document(DocumentModel $document_model): Document
    {
        $document_attributes = $document_model->toArray();
        $document_attributes['types'] = $document_model->types();

        return new Document($document_attributes);
    }
}
