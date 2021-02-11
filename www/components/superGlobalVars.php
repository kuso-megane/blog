<?php

namespace myapp\components;


class superGlobalVars
{

    public function get_GET():array
    {
        return $_GET;
    }


    public function get_POST():array
    {
        return $_POST;
    }


    public function get_SERVER():array{
        return $_SERVER;
    }
}