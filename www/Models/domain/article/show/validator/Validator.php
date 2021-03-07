<?php

namespace domain\article\show\validator;

use domain\article\show\Data\InputData;

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