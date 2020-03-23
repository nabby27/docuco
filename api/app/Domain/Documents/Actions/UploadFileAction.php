<?php

namespace Docuco\Domain\Documents\Actions;

use Illuminate\Http\UploadedFile;

class UploadFileAction
{
    private $repository;

    public function __construct()
    {
    }

    public function execute(UploadedFile $file): string
    {
        $name = time() . '.' . $file->getClientOriginalExtension();
        $destination_path = public_path('/assets/documents');
        $file->move($destination_path, $name);
        return '/assets/documents/' . $name;
    }
}
