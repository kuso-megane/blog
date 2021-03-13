<?php

namespace domain\backyardArticle\index;

use domain\backyardArticle\index\Data\ArticleLink;
use myapp\config\AppConfig;

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
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportValidationFailure(?string $message = 'Invalid url was given'):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
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
