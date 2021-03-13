<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\backyardArticle\index\Interactor as IndexInteractor;
use domain\backyardArticle\edit\Interactor as EditInteractor;
use myapp\config\AppConfig;

class BackyardArticleController extends BaseController
{


    public function index (?array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(IndexInteractor::class);
        $vm = $interactor->interact();

        if ($vm == AppConfig::INVALID_PARAMS) {
            return FALSE;
        }
        else {
            $this->render($vm, 'backyardArticle', 'index');
        } 
    }


    public function edit (array $vars = NULL)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(EditInteractor::class);
        $vm = $interactor->interact($vars);

        if ($vm == AppConfig::INVALID_PARAMS) {
            return FALSE;
        }
        else {
            $this->render($vm, 'backyardArticle', 'edit');
        }
    }


    public function post (array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(EditInteractor::class);
        $exe = $interactor->interact($vars);

        if ($exe == AppConfig::INVALID_PARAMS) {
            return FALSE;
        }
        elseif ($exe == AppConfig::POST_SUCCESS) {
            //保留
        }    
    }

}
