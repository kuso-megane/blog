<?php

namespace domain\components\mainSidebar\validator;

use domain\components\mainSidebar\Data\InputData;
use domain\Exception\ValidationFailException;
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
        $word = $get['w'];

        if (strlen($word) > 30) {
            throw new ValidationFailException('検索ワードが長すぎます。30文字以内にしてください');
        }

        return new InputData($word);
    }
}
