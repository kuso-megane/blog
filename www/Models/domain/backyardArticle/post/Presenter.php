<?php

namespace domain\backyardArticle\post;

use myapp\config\AppConfig;

class Presenter
{

    /**
     * Call when post succeeded
     * @param string|NULL $message
     * 
     */
    public function reportSuccess():int 
    {

    }


    /**
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportInValidParams(?string $message = 'Invalid url was given'):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
    }
}