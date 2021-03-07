<?php

namespace domain\article\show;

use domain\article\show\Data\Article;

class Presenter
{
    /**
     * @param Article $article
     * 
     * @return array [
     *      'c_id' => int,
     *      'subc_id' => int,
     *      'title' => string,
     *      'thumbnailName' => string,
     *      'content' => string,
     *      'updateDate' => string
     * ]
     * +components\breadCrumb\Interactor->interact()
     * +components\mainSidebar\Interactor->interact()
     */
    public function present(Article $article, array $breadCrumbData, array $mainSidebarData):array
    {
        $data = $article->toArray();

        return $data + $breadCrumbData + $mainSidebarData;
    }
}
