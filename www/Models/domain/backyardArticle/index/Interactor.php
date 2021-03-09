<?php

namespace domain\backyardArticle\index;

use domain\backyardArticle\index\RepositoryPort\ArticleLinksRepositoryPort;
use domain\backyardArticle\index\Presenter;

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
        $articleLinks = $this->articleLinksRepository->getArticleLinks();

        return (new Presenter)->present($articleLinks);
    }
}
