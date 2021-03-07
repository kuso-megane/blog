<?php

namespace domain\article\show\RepositoryPort;

use domain\article\show\Data\Article;

interface ArticleRepositoryPort
{
    /**
     * @param $input
     * 
     * @return Article
     */
    public function getArticle(array $input): Article;
}