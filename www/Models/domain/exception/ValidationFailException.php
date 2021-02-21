<?php

namespace domain\Exception;

use Exception;


class ValidationFailException extends Exception
{
    public function __construct(string $target, string $expected, $given)
    {
        if ($given == NULL)
        {
            $given = 'NULL';
        }

        $message = "{$target} is expected to be {$expected}, {$given} is given\n";
        parent::__construct($message);
    }
}