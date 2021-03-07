<?php

namespace domain\article\validator;

use domain\article\Data\InputData;
use PhpParser\Node\Expr\Cast\Int_;

class validator
{
    
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars): InputData
    {
        $id = (int)$vars['artcl_id'];

        return new InputData($id);
    }
}