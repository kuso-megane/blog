<?php

namespace domain\backyardArticle\edit\Validator;

use domain\backyardArticle\edit\Data\InputData;
use TypeError;
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
        $id = $vars['artcl_id'];

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
