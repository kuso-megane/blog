<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\Data\OldArticleContent;

class Presenter
{
    /**
     * @param bool $isNew
     * @param OldArticleContent|NULL $oldArticleContent
     * 
     * @param array [
     *      'isNew' => bool,
     *      'artcl_id' => int|NULL,
     *      'oldTitle' => string|NULL,
     *      'oldContent' => string|NULL
     * ]
     */
    public function present(bool $isNew, ?OldArticleContent $oldArticleContent):array
    {

        $oldArticleContent = ($oldArticleContent != NULL) ? $oldArticleContent->toArray() : [];

        $artcl_id = $oldArticleContent['id'];
        $oldTitle = $oldArticleContent['title'];
        $oldContent = $oldArticleContent['content'];

        return [
            'isNew' => $isNew,
            'artcl_id' => $artcl_id,
            'oldTitle' => $oldTitle,
            'oldContent' => $oldContent
        ];
    }
}
