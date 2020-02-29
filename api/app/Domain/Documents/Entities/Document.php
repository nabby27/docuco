<?php

namespace Docuco\Domain\Documents\Entities;

class Document
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $url;
    public $dateOfIssue;
    public $users_group_id;
    public $updated_at;
    public $created_at;

    public function __construct(array $attributes = [])
    {
        foreach ($this as $property => $value) {
            $this->$property = $attributes[$property];
        }
    }
}
