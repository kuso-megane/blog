<?php

namespace myapp\Controllers;

use myapp\myFrameWork\Bases\BaseController;


class BackyardController extends BaseController
{


    public function index (?array $vars)
    {
        //modelから記事一覧を持ってくる
        //$data = 

        require $this::VIEW_FILE_PATH.'backyard/article/index.php';
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