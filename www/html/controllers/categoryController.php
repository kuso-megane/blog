<?php

namespace myapp\controllers;

require 'viewFilePath.php';


class CategoryController
{


    public function index()
    {
        //modelから最新投稿を持ってくる
        //$data = 

        require VIEW_FILE_PATH.'category/index.php';
    }


    public function list(array $var)
    {
        //modelから該当カテゴリの最新投稿を持ってくる
        //$data =
        require VIEW_FILE_PATH.'category/list.php';   
    }
}