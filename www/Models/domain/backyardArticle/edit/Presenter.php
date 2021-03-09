<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\Data\OldArticleContent;

class Presenter
{
    /**
     * @param OldArticleContent $oldArticleContent
     * 
     * @param array [
     *      'oldArticleContent' => ['id' => int, 'title' => string, 'content' => string]
     * ]
     */
    public function present(OldArticleContent $oldArticleContent):array
    {

        return [
            'oldArticleContent' => $oldArticleContent->toArray()
        ];
    }
}
