<?php

namespace domain\article\show;

use domain\article\show\Data\ArticleContent;

class Presenter
{
    /**
     * @param Article $article
     * 
     * @return array [
     *      'c_id' => int,
     *      'subc_id' => int,
     *      'title' => string,
     *      'content' => string,
     *      'updateDate' => string
     * ]
     * +components\breadCrumb\Interactor->interact()
     * +components\mainSidebar\Interactor->interact()
     */
    public function present(array $article, array $breadCrumbData, array $mainSidebarData):array
    {
        $data = $article;

        return $data + $breadCrumbData + $mainSidebarData;
    }
}
