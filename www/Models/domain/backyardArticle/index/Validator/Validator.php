<?php

namespace domain\backyardArticle\index\Validator;

use domain\backyardArticle\index\Data\InputData;
use myapp\myFrameWork\SuperGlobalVars;

class Validator
{
    /**
     * @param array $input
     * 
     * @return InputData
     */
    public function validate():InputData
    {
        $get= (new SuperGlobalVars)->getGet();

        $word = (string)$get['w'];

        return new InputData($word);
    }
}
