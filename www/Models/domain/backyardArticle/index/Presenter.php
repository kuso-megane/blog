<?php

namespace domain\backyardArticle\index;

use domain\backyardArticle\index\Data\ArticleLink;

class Presenter
{
    /**
     * @param ArticleLink[] $articleLinks
     * 
     * @return array [
     *      'articleLinks' => [ ['id' => int, 'title' => string], [] ]
     * ]
     */
    public function present(array $articleLinks):array
    {
        return [
            'articleLinks' => $this->formatForArticleLinks($articleLinks)
        ];
    }


    /**
     * @param ArticleLink[] $articleLinks
     * 
     * @param array [
     *      ['id' => int, 'title' => string],
     *      []
     * ]
     */
    private function formatForArticleLinks(array $articleLinks):array
    {
        foreach($articleLinks as &$articleLink) {
            $articleLink = $articleLink->toArray();
        }

        return $articleLinks;
    }
}
