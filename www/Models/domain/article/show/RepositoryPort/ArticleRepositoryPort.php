<?php

namespace domain\article\show\RepositoryPort;

use domain\article\show\Data\ArticleContent;

interface ArticleRepositoryPort
{
    /**
     * @param array $input
     * 
     * @return Article
     */
    public function getArticle(array $input): ArticleContent;
}