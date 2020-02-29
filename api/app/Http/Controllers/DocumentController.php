<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryORM;

class DocumentController extends Controller
{
    private $documentRepository;

    public function __construct()
    {
        $this->documentRepository = new DocumentsRepositoryORM();
    }

    public function getAllDocuments()
    {
        $documents = [];
        return response()->json(['documents' => $documents], 200);
    }
}
