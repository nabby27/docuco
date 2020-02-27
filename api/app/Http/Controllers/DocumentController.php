<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Docuco\Http\Controllers\Controller;
use Docuco\Infrastructure\Repositories\Document\DocumentRepositoryORM;

class DocumentController extends Controller
{
    private $documentRepository;

    public function __construct()
    {
        $this->documentRepository = new DocumentRepositoryORM();
    }
}
