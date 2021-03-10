<?php

namespace domain\article\show;

use domain\article\show\Data\ArticleContent;

class Presenter
{
    /**
     * @param ArticleContent|NULL $article
     * @param array $breadCrumbData
     * @param array $mainSidebarData
     * 
     * @return array [
     *      'articleContent' 
     *       => [
     *              'c_id' => int,
     *              'subc_id' => int,
     *              'title' => string,
     *              'content' => string,
     *              'updateDate' => string
     *          ]
     * ]
     * +components\breadCrumb\Interactor->interact()
     * +components\mainSidebar\Interactor->interact()
     *  
     */
    public function present(?ArticleContent $article, array $breadCrumbData, array $mainSidebarData):array
    {
        $data = ($article != NULL) ? $article->toArray() : [];

        return ['articleContent' => $data] + $breadCrumbData + $mainSidebarData;
    }
}
