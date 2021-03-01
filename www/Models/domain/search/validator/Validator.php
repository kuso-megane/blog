<?php

namespace domain\search\validator;

use domain\search\data\InputData;

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
        
        $c_id = $vars['c_id'];
        $subc_id = $vars['subc_id'];
        $word = $vars['word'];

        return new InputData($pageId, $c_id, $subc_id, $word);
    }
}