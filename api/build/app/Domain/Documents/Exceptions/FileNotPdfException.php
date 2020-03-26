<?php

namespace Docuco\Domain\Users\Exceptions;

use Docuco\Shared\Exceptions\DomainException;

class FileNotPdfException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            'File must be pdf type.',
            400
        );
    }
}
