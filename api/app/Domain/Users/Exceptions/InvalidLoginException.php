<?php

namespace Docuco\Domain\Users\Exceptions;

use Docuco\Shared\Exceptions\DomainException;

class InvalidLoginException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            'You have entered an invalid username or password.',
            401
        );
    }
}
