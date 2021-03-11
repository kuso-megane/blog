<?php

namespace domain\backyardArticle\post;

use myapp\config\AppConfig;
use domain\Exception\ValidationFailException;
use domain\backyardArticle\post\Validator\Validator;
use domain\backyardArticle\post\RepositoryPort\ArticlePostRepositoryPort;

class Interactor
{
    private $articlePostRepository;


    public function __construct(ArticlePostRepositoryPort $articlePostRepository)
    {
        $this->articlePostRepository = $articlePostRepository;
    }


    /**
     * @param array $vars
     * 
     * @return int AppConfig::POST_SUCCESS or AppConfig::INVALID_PARAMS
     * 
     * if validation fails, this returns AppConfig::INVALID_PARAMS
     */
    public function interact(array $vars)
    {
        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            echo $e->getMessage();
            return AppConfig::INVALID_PARAMS;
        }

        $artcl_id = $input['artcl_id'];
        $title = $input['title'];
        $content = $input['content'];

        $this->articlePostRepository->post($artcl_id, $title, $content);


        return AppConfig::POST_SUCCESS;
    }
    
}
