<?php

namespace domain\backyardArticle\index\Validator;

use domain\backyardArticle\index\Data\InputData;
use myapp\myFrameWork\SuperGlobalVars;
use domain\Exception\ValidationFailException;
use TypeError;

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
        if (strlen($word) > 30) {
            throw new ValidationFailException('検索文字が長すぎます。30文字以内で検索してください。');
        }

        try {
            return new InputData($word);
        }
        catch (TypeError $e) {
            throw new ValidationFailException('与えられたパラメータの型が違います。');
        }
        
    }
}
