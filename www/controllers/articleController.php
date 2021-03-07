<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\article\Interactor;


class ArticleController extends BaseController
{


    public function show(array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(Interactor::class);
        $vm = $interactor->interact($vars);

        $this->render($vm, 'article', 'show');
    }
 
}