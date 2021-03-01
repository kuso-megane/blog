<?php

namespace domain\search;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use domain\search\Presenter;
use domain\search\validator\Validator;
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

        $input = (new Validator)->validate($vars)->toArray();


        $isLastPageAndRecentArtclInfos = $this->recentArtclInfosRepository->getIsLastPageAndRecentArtclInfos($input, $artclNum);
        $isLastPage = $isLastPageAndRecentArtclInfos[0];
        $recentArtclInfos = $isLastPageAndRecentArtclInfos[1];

        $categoryArtclCount = $this->categorySearchListRepository->getCategoryArtclCount();
        $subCategoryArtclCount = $this->categorySearchListRepository->getSubCategoryArtclCount();

        return (new Presenter())->present($input, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount);
    }
}