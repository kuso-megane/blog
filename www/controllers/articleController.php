<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;


class ArticleController extends BaseController
{


    public function show(array $vars)
    {
        //modelから記事情報を持ってくる
        //$data = 

        require $this::VIEW_FILE_PATH.'article/show.php';
    }
 
}