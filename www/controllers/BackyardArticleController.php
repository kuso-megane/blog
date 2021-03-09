<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;
use domain\backyardArticle\index\Interactor as IndexInteractor;


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


    public function edit (?array $vars = NULL)
    {
        // 記事がすでにある場合
        $isNew = ($vars == NULL) ? TRUE : FALSE;
        if (!($isNew)) {
            //modelから記事情報を持ってくる
            //$data =
        }
        
        require $this::VIEW_FILE_PATH.'backyard/article/edit.php';
    }


    public function post (array $vars)
    {
        //modelから最新投稿を持ってくる
        //$data =
           
    }

}