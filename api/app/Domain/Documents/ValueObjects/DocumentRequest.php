<?php

namespace Docuco\Domain\Documents\ValueObjects;

class DocumentRequest
{
    private $name;
    private $description;
    private $type;
    private $price;
    private $date_of_issue;
    private $url;

    public function __construct(
        string $name,
        string $description,
        string $type,
        float $price,
        string $date_of_issue,
        File $file
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->price = $price;
        $this->date_of_issue = $date_of_issue;
        $this->file = $file;
    }

    public function uploadFile()
    {
        $this->url = $this->file->upload();
    }
}
