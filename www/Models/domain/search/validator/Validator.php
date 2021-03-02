<?php

namespace domain\search\validator;

use domain\search\data\InputData;
use myapp\myFrameWork\superGlobalVars as Gvars;

class validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $get = (new Gvars())->getGet();
        $pageId = (int)$get['p'];
        if ($pageId == NULL) {
            $pageId = 1;
        }

        $word = (string)$get['w'];
        
        $c_id = (int)$vars['c_id'];
        $subc_id = (int)$vars['subc_id'];
        

        return new InputData($pageId, $c_id, $subc_id, $word);
    }
}