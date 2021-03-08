<?php

namespace domain\article\show\RepositoryPort;

use domain\article\show\Data\ArticleContent;

interface ArticleContentRepositoryPort
{
    /**
     * @param int
     * 
     * @return Article
     */
    public function getArticleContent(int $id): ArticleContent;
}