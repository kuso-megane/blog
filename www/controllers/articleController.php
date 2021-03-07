<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\article\show\Interactor as ShowInteractor;


class ArticleController extends BaseController
{


    public function show(array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(ShowInteractor::class);
        $vm = $interactor->interact($vars);

        $this->render($vm, 'article', 'show');
    }
 
}