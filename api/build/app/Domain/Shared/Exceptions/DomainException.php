<?php

namespace Docuco\Shared\Exceptions;

use Exception;

class DomainException extends Exception
{
    protected $http_code;
    protected $message;

    public function __construct(string $message, string $http_code)
    {
        $this->http_code = $http_code;
        $this->message = $message;
    }

    public function http_code()
    {
        return $this->http_code;
    }

    public function message()
    {
        return $this->message;
    }
}
