<?php

namespace domain\backyardArticle\index;

use domain\backyardArticle\index\RepositoryPort\ArticleLinksRepositoryPort;
use domain\backyardArticle\index\Presenter;
use domain\backyardArticle\index\Validator\Validator;
use domain\Exception\ValidationFailException;

class Interactor
{
    private $articleLinksRepository;

    public function __construct(ArticleLinksRepositoryPort $articleLinksRepository)
    {
        $this->articleLinksRepository = $articleLinksRepository;
    }


    /**
     * @return array refer to Presenter->present()
     */
    public function interact():array
    {
        try {
            $input = (new Validator)->validate()->toArray();
        }
        catch (ValidationFailException $e) {
            return (new Presenter)->reportValidationFailure($e->getMessage());
        }
        
        $searched_word = $input['searched_word'];

        $articleLinks = $this->articleLinksRepository->getArticleLinks($searched_word);

        return (new Presenter)->present($articleLinks);
    }
}
