<?php

namespace domain\backyardArticle\edit\RepositoryPort;

use domain\backyardArticle\edit\Data\OldArticleContent;

interface OldArticleContentRepositoryPort
{
    /**
     * @param int $artcl_id
     * 
     * @return OldArticleContent|NULL
     */
    public function getOldArticleContent(int $artcl_id): ?OldArticleContent;
}
