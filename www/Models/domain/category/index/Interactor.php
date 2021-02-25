<?php

namespace domain\category\index;

use domain\category\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use domain\category\index\Presenter;
use domain\category\index\validator\Validator;
use myapp\Models\Config;

class Interactor
{

    private $recentArtclInfosRepository;
    private $categorySearchListRepository;

    
    public function __construct(RecentArtclInfosRepositoryPort $recentArtclInfosRepository,
    CategorySearchListRepositoryPort $categorySearchListRepository)
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
        $this->categorySearchList = $categorySearchListRepository;
    }
    


    /**
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $vars):array
    {
        $artclNum = (new Config)::ARTCL_NUM;

        $input = (new Validator)->validate($vars);
        $pageId = $input->toArray()['pageId'];

        $recentArtclInfos = $this->recentArtclInfosRepository->getRecentArtclInfos($pageId, $artclNum);
        $isLastPage = $this->recentArtclInfosRepository->getIsLastPage($pageId, $artclNum);

        $categoryArtclCount = $this->categorySearchListRepository->getCategoryArtclCount();
        $subCategoryArtclCount = $this->categorySearchListRepository->getSubCategoryArtclCount();

        return (new Presenter())->present($pageId, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount);
    }
}