<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\backyardArticle\index\Interactor as IndexInteractor;
use domain\backyardArticle\edit\Interactor as EditInteractor;


class BackyardArticleController extends BaseController
{


    public function index (?array $vars)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(IndexInteractor::class);
        $vm = $interactor->interact();

        $this->render($vm, 'backyardArticle', 'index');
    }


    public function edit (array $vars = NULL)
    {
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions('/var/www/Models/diconfig.php');
        $container = $builder->build();

        $interactor = $container->get(EditInteractor::class);
        $vm = $interactor->interact($vars);

        $this->render($vm, 'backyardArticle', 'edit');
    }


    public function post (array $vars)
    {
        //modelから最新投稿を持ってくる
        //$data =
           
    }

}