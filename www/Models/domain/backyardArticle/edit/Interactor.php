<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\RepositoryPort\OldArticleContentRepositoryPort;
use domain\backyardArticle\edit\Validator\Validator;
use domain\backyardArticle\edit\Presenter;

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
     * @return array refer to Presenter->present()
     */
    public function interact(array $vars):array
    {
        $input = (new Validator)->validate($vars)->toArray();

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
