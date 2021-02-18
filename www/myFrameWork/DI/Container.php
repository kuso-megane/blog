<?php

namespace myapp\myFrameWork\DI;

use myapp\myFrameWork\DI\exception\DIFailException;

use infra\Repository\components\CategorySearchListRepository;
use domain\components\categorySearchList\CategorySearchListService;

class Container
{

    /**
     * return instance of given class and execute constructer injection
     * @param string $className
     */
    public function getInstance(string $className)
    {
        try {

            if ($className == 'CategorySearchListService') {
                return new CategorySearchListService(new CategorySearchListRepository);
            }
            else {
                throw new DIFailException();
            }

        } catch (DIFailException $e) {

            echo $e->getMessage(). "\n";

        }   
    }
}