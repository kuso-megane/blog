<?php

namespace domain\components\breadCrumb\validator;

use domain\components\breadCrumb\Data\InputData;
use domain\Exception\ValidationFailException;

class Validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $c_id = ($vars['c_id'] != NULL) ? (int) $vars['c_id'] : NULL;
        if (!($c_id === NULL || $c_id > 0)) {
            throw new ValidationFailException('想定外のカテゴリを指定しています。');
        }

        $subc_id = ($vars['subc_id'] != NULL) ? (int) $vars['subc_id'] : NULL;
        if (!($subc_id === NULL || $subc_id > 0)) {
            throw new ValidationFailException('想定外のサブカテゴリを指定しています。');
        }
        
        
        return new InputData($c_id, $subc_id);
    }
}
