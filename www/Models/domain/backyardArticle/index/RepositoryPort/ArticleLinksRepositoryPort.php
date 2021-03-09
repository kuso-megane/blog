<?php

namespace domain\backyardArticle\index\RepositoryPort;

use domain\backyardArticle\index\Data\ArticleLink;

interface ArticleLinksRepositoryPort
{
    /**
     * @return ArticleLink[]
     */
    public function getArticleLinks(): array;
}
