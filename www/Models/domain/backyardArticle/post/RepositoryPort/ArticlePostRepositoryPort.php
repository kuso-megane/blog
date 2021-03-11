<?php

namespace domain\backyardArticle\post\RepositoryPort;

interface ArticlePostRepositoryPort
{
    /**
     * @param int|NULL $artcl_id
     * @param string $title
     * @param string $content
     * 
     * @return void
     */
    public function postArticle(?int $artcl_id, string $title, string $content):void;
}
