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

        $interactor = $container->get('domain\search\Interactor');
        $vm = $interactor->interact($vars);
        render($vm, 'search', 'index');
    }


    //カテゴリ検索
    public function result(array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get('domain\search\Interactor');
        $vm = $interactor->interact($vars);
        render($vm, 'search', 'result');
    }
}