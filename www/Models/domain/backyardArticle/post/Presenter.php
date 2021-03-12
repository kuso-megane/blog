<?php

namespace domain\backyardArticle\post;

use myapp\config\AppConfig;

class Presenter
{

    /**
     * 
     */
    public function present():array
    {

    }


    /**
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportInValidParams(?string $message):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
    }
}