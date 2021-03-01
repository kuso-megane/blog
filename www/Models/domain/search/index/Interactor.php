<?php

namespace domain\search\index;

use domain\search\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use domain\search\index\Presenter;
use domain\search\index\validator\Validator;
use myapp\config\AppConfig;

class Interactor
{

    private $recentArtclInfosRepository;
    private $categorySearchListRepository;

    
    public function __construct(RecentArtclInfosRepositoryPort $recentArtclInfosRepository,
    CategorySearchListRepositoryPort $categorySearchListRepository)
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
        $this->categorySearchListRepository = $categorySearchListRepository;
    }
    


    /**
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $vars):array
    {
        $artclNum = (new AppConfig)::ARTCL_NUM;

        $input = (new Validator)->validate($vars);
        $pageId = $input->toArray()['pageId'];

        $isLastPageAndRecentArtclInfos = $this->recentArtclInfosRepository->getIsLastPageAndRecentArtclInfos($pageId, $artclNum);
        $isLastPage = $isLastPageAndRecentArtclInfos[0];
        $recentArtclInfos = $isLastPageAndRecentArtclInfos[1];

        $categoryArtclCount = $this->categorySearchListRepository->getCategoryArtclCount();
        $subCategoryArtclCount = $this->categorySearchListRepository->getSubCategoryArtclCount();

        return (new Presenter())->present($pageId, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount);
    }
}