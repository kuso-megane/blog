<?php

namespace domain\components\mainSidebar\validator;

use domain\components\mainSidebar\Data\InputData;
use myapp\myFrameWork\SuperGlobalVars as GVars;

class Validator
{
    /**
     * 
     * @return InputData
     */
    public function validate():InputData
    {
        $get = (new Gvars())->getGet();
        $word = (string)$get['w'];

        return new InputData($word);
    }
}
