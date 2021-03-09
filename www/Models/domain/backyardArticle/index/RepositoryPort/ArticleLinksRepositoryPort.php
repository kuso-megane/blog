<?php

namespace domain\backyardArticle\index\RepositoryPort;

use domain\backyardArticle\index\Data\ArticleLink;

interface ArticleLinksRepositoryPort
{
    /**
     * @param string|NULL $searched_word
     * 
     * @return ArticleLink[]
     */
    public function getArticleLinks(?string $searched_word): array;
}
