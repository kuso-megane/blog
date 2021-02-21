<?php

namespace myapp\controllers;

require __DIR__. '/viewFilePath.php';
require __DIR__. '/helpers/render.php';

use domain\category\index\Interactor;


class CategoryController
{


    public function index(?array $vars)
    {
        


        $vm = (new Interactor())->interact($vars);
        render($vm, 'category', 'index');
    }


    //カテゴリ検索
    public function searchResult(array $var)
    {
        //modelから該当カテゴリの最新投稿を持ってくる
        //$data =
        require '/var/www/html/views/category/searchResult.php';   
    }
}