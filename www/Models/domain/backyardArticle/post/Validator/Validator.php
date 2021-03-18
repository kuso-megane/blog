<?php

namespace domain\backyardArticle\post\Validator;

use domain\backyardArticle\post\Data\InputData;
use TypeError;
use domain\Exception\ValidationFailException;
use myapp\myFrameWork\SuperGlobalVars as GVars;

class Validator
{
    public function validate(array $vars):InputData
    {
        $artcl_id = ($vars['artcl_id'] != NULL) ? (int) $vars['artcl_id'] : NULL;

        if (!($artcl_id == NULL || $artcl_id > 0)) {
            throw new ValidationFailException('想定外の記事が指定されています。');
        }

        $post = (new GVars)->getPost();

        $c_id = ($post['c_id'] != NULL) ? (int) $post['c_id'] : NULL;

        if (!($c_id != NULL && $c_id > 0)) {
            throw new ValidationFailException('想定外のカテゴリが指定されています。');
        }

        $subc_id = ($post['subc_id'] != NULL) ? (int) $post['subc_id'] : NULL;

        if (!($subc_id != NULL && $subc_id > 0)) {
            throw new ValidationFailException('想定外のサブカテゴリが指定されています。');
        }

        $title = $post['title'];
        $title = htmlspecialchars($title);
        $len_title = strlen($title);
        if (!($len_title > 0 && $len_title <= 30)) {
            throw new ValidationFailException('タイトルの文字数が不適です。');
        }

        //$thumbnailName = 

        $content = $post['content'];

        //to avoid inner string "srcipt" being recognized as terminal of script of article/show.php
        $content = str_replace(['<script>', '</script>'], '', $content);

        $len_content = strlen($content);
        if (!($len_content > 0 && $len_content <  65535)) {
            throw new ValidationFailException('記事内容の文字数が不適です。');
        }


        try {
            return new InputData($artcl_id, $c_id, $subc_id, $title, NULL, $content);
        }
        catch (TypeError $e) {
            throw new ValidationFailException('与えられたパラメータの型が違います。');
        }
    }
}