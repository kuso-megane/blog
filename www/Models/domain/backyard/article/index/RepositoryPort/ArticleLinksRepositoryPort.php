<?php

namespace domain\backyard\article\index\RepositoryPort;

use domain\backyard\article\index\Data\ArticleLink;

interface ArticleLinksRepositoryPort
{
    /**
     * @return ArticleLink[]
     */
    public function getArticleLinks(): array;
}
