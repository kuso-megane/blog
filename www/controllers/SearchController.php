<?php

namespace myapp\Controllers;

require __DIR__. '/helpers/render.php';


class SearchController
{


    public function index(?array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get('domain\search\index\Interactor');
        $vm = $interactor->interact($vars);
        render($vm, 'search', 'index');
    }


    //カテゴリ検索
    public function result(array $var)
    {
        //modelから該当カテゴリの最新投稿を持ってくる
        //$data =
        require '/var/www/html/views/search/result.php';   
    }
}