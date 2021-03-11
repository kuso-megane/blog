<?php

namespace domain\backyardArticle\post\RepositoryPort;

interface ArticlePostRepositoryPort
{
    /**
     * @param int|NULL $artcl_id
     * @param int $c_id
     * @param int $subc_id
     * @param string $title
     * @param string|NULL $thumbnailName
     * @param string $content
     * 
     * @return void
     */
    public function postArticle(?int $artcl_id, int $c_id, int $subc_id, string $title,
    ?string $thumbnailName, string $content):void;
}
