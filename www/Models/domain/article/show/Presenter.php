<?php

namespace domain\article\show;

use domain\article\show\Data\ArticleContent;
use myapp\config\AppConfig;

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


    /**
     * Call when validation failed.
     * @param string|NULL $message
     * 
     * @return int AppConfig::INVALID_PARAMS
     */
    public function reportInValidParams(?string $message = 'Invalid url was given'):int
    {
        http_response_code(400);
        echo $message;

        return AppConfig::INVALID_PARAMS;
    }
}
