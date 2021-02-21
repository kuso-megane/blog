<?php

namespace domain\Exception;

use Exception;


class ValidationFailException extends Exception
{
    
    /**
     * @param string $targetName target of validation
     * @param string $expected expected type or something of the target
     * @param mixed $given actual given values
     */
    public function __construct(string $targetName, string $expected, $given)
    {
        if ($given == NULL)
        {
            $given = 'NULL';
        }

        $message = "{$targetName} is expected to be {$expected}, {$given} is given\n";
        parent::__construct($message);
    }
}