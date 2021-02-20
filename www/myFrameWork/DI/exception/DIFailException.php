<?php

namespace myapp\myFrameWork\DI\exception;

use Exception;

class DIFailException extends Exception
{
    public function __construct(string $className)
    {
        $this->message = "cannot create an instance of unknown class: {$className}\n";
    }
}
