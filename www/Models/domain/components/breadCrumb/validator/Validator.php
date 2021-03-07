<?php

namespace domain\components\breadCrumb\validator;

use domain\components\breadCrumb\Data\InputData;

class Validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $c_id = (int)$vars['c_id'];
        $subc_id = (int)$vars['subc_id'];
        
        return new InputData($c_id, $subc_id);
    }
}
