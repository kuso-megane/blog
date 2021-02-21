<?php

namespace domain\category\index\validator;

use domain\category\index\data\InputData;

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
        if ($pageId == NULL) {
            $pageId = 1;
        }
        
        return new InputData($pageId);
    }
}