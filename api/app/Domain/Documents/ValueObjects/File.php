<?php

namespace Docuco\Domain\Documents\ValueObjects;

use Docuco\Domain\Users\Exceptions\FileNotPdfException;

class File
{
    private $name;
    private $type;
    private $extension;
    private $size;
    private $tmp;

    public function __construct(
        string $name,
        string $type,
        string $extension,
        string $size,
        string $tmp
    ) {
        $this->ensureTypeIsPDF($type);
        $this->name = $name;
        $this->type = $type;
        $this->extension = $extension;
        $this->size = $size;
        $this->tmp = $tmp;
    }

    private function ensureTypeIsPDF(string $type)
    {
        if ('application/pdf' !== $type) {
            throw new FileNotPdfException();
        }
    }

    public function name()
    {
        return $this->name;
    }

    public function type()
    {
        return $this->type;
    }

    public function extension()
    {
        return $this->extension;
    }

    public function size()
    {
        return $this->size;
    }

    public function tmp()
    {
        return $this->tmp;
    }

    public function upload(): string
    {
        $name = uniqid() . '.' . $this->extension();
        $full_name = '/assets/documents/' . $name;
        move_uploaded_file($this->tmp, $full_name);
        return $full_name;
    }
}
