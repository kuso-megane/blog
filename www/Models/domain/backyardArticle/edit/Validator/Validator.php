<?php

namespace domain\backyardArticle\edit\Validator;

use domain\backyardArticle\edit\Data\InputData;

class Validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $artcl_id = (int) $vars['artcl_id'];

        return new InputData($artcl_id);
    }
}
