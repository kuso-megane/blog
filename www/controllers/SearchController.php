<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\search\Interactor;


class SearchController extends BaseController
{


    public function index(?array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(Interactor::class);
        $vm = $interactor->interact($vars);
        $this->render($vm, 'search', 'index');
    }


    //カテゴリ検索
    public function result(array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(Interactor::class);
        $vm = $interactor->interact($vars);
        $this->render($vm, 'search', 'result');
    }
}