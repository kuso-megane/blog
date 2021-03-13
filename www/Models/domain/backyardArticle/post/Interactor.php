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
     * if post succeeds, this returns AppConfig::POST_SUCCESS
     */
    public function interact(array $vars)
    {
        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportValidationFailure($e->getMessage());
        }

        $artcl_id = $input['artcl_id'];
        $c_id = $input['c_id'];
        $subc_id = $input['subc_id'];
        $title = $input['title'];
        $thumbnailName = $input['thumbnailName'];
        $content = $input['content'];

        $isSuccess = $this->articlePostRepository->postArticle($artcl_id, $c_id, $subc_id, $title, $thumbnailName, $content);


        return (new Presenter)->present($isSuccess);
    }
    
}
