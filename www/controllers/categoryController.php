<?php

namespace myapp\controllers;

require __DIR__. '/viewFilePath.php';
require __DIR__. '/helpers/render.php';

use domain\category\index\Interactor;


class CategoryController
{


    public function index(?array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get('domain\category\index\Interactor');
        $vm = $interactor->interact($vars);
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