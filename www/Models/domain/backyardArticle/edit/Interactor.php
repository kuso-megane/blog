<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\RepositoryPort\OldArticleContentRepositoryPort;
use domain\backyardArticle\edit\Validator\Validator;
use domain\backyardArticle\edit\Presenter;
use domain\Exception\ValidationFailException;
use myapp\config\AppConfig;

class Interactor
{
    private $oldArticleContentRepository;

    public function __construct(OldArticleContentRepositoryPort $oldArticleContentRepository)
    {
        $this->oldArticleContentRepository = $oldArticleContentRepository;
    }


    /**
     * @param array $vars
     * 
     * @return array|int refer to Presenter->present()
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

        if ($artcl_id == NULL) {
            $isNew = TRUE;
            $oldArticleContent = NULL;
        }
        elseif ($artcl_id != NULL) {
            $isNew = FALSE;
            $oldArticleContent = $this->oldArticleContentRepository->getOldArticleContent($artcl_id);
        }

        
        return (new Presenter)->present($isNew, $oldArticleContent);
    }
}
