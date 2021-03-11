<?php

namespace domain\backyardArticle\post\RepositoryPort;

interface ArticlePostRepositoryPort
{
    /**
     * @param int $artcl_id
     * @param string $title
     * @param string $content
     * 
     * @return void
     */
    public function post(int $artcl_id, string $title, string $content):void;
}
