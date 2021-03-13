<?php

namespace domain\backyardArticle\post;

use myapp\config\AppConfig;

class Presenter
{

    /**
     * Call when post finished whether or not it succeeded
     * @param bool $isSuccess
     * 
     * @return int AppConfig::POST_SUCCESS | AppConfig::POST_FAILURE
     */
    public function present(bool $isSuccess):int 
    {
        if ($isSuccess === TRUE) {
            http_response_code(201);
            return AppConfig::POST_SUCCESS;
        }
        elseif ($isSuccess === FALSE) {
            http_response_code(403);
            return AppConfig::POST_FAILURE;
        }
    }


    /**
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportValidationFailure(?string $message = 'Invalid url was given'):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
    }
}
