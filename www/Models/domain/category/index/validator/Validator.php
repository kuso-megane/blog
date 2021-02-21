<?php

namespace domain\category\index\validator;

use domain\category\index\data\InputData;
use domain\Exception\ValidationFailException;

class validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $pageId = $vars['pageId'];

        if (is_int($pageId) == FALSE)
        {
            $e = new ValidationFailException('pageId', 'int', $pageId);
            echo $e->getMessage();
        }
        
        return new InputData($pageId);
    }
}