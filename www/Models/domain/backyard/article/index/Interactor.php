<?php

namespace domain\backyard\article\index;

use domain\backyard\article\index\RepositoryPort\ArticleLinksRepositoryPort;
use domain\backyard\article\index\Presenter;

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
