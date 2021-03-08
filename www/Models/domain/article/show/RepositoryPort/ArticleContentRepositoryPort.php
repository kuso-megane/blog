<?php

namespace domain\article\show\RepositoryPort;

use domain\article\show\Data\ArticleContent;

interface ArticleContentRepositoryPort
{
    /**
     * @param array $input
     * 
     * @return Article
     */
    public function getArticleContent(array $input): ArticleContent;
}