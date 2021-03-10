<?php

namespace domain\article\show\validator;

use domain\article\show\Data\InputData;
use domain\Exception\ValidationFailException;
use TypeError;

class validator
{
    
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars): InputData
    {
        $id = (int) $vars['artcl_id']; //文字列としてくるのでキャスト、キャストできないものは0になる

        if ($id <= 0) {
            throw new ValidationFailException('想定外の記事が指定されています');
        }

        try {
            return new InputData($id);
        }
        catch (TypeError $e) {
            throw new ValidationFailException('与えられたパラメータの型が違います。');
        }
        
    }
}