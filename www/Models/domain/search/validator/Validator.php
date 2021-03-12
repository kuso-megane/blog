<?php

namespace domain\search\validator;

use domain\Exception\ValidationFailException;
use domain\search\data\InputData;
use myapp\myFrameWork\superGlobalVars as Gvars;
use TypeError;

use function PHPUnit\Framework\throwException;

class validator
{
    /**
     * @param array $vars
     * 
     * @return InputData
     */
    public function validate(array $vars):InputData
    {
        $get = (new Gvars())->getGet();
        $pageId = $get['p'];
        if ($pageId === NULL) {
            $pageId = 1;
        }
        elseif (!($pageId > 0 && $pageId <= 100000)) {
            throw new ValidationFailException('存在しないページを指定しています。');
        }

        $word = $get['w'];
        if (strlen($word) > 30) {
            throw new ValidationFailException('検索文字が長すぎます。30文字以内で検索してください。');
        }
        
        $c_id = ($vars['c_id'] != NULL) ? (int) $vars['c_id'] : NULL;
        if (!($c_id === NULL || $c_id > 0)) {
            throw new ValidationFailException('想定外のカテゴリを指定しています。');
        }

        $subc_id = ($vars['subc_id'] != NULL) ? (int) $vars['subc_id'] : NULL;
        if (!($subc_id === NULL || $subc_id > 0)) {
            throw new ValidationFailException('想定外のサブカテゴリを指定しています。');
        }
        
        
        try {
            $inputData = new InputData($pageId, $c_id, $subc_id, $word);
        }
        catch (TypeError $e) {
            throw new ValidationFailException('与えられたパラメータの型が違います。');
        }

        return  $inputData;
    }
}
