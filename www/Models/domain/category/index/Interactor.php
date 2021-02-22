<?php

namespace domain\category\index;

use domain\category\index\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use domain\category\index\Presenter;
use domain\category\index\validator\Validator;

class Interactor
{
    const ARTCL_NUM = 9; //1ページあたりの記事数

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
        $input = (new Validator)->validate($vars);
        $pageId = $input['pageId'];

        $recentArtclInfos = $this->recentArtclInfosRepository->getRecentArtclInfos($pageId, $this::ARTCL_NUM);
        $isLastPage = $this->recentArtclInfosRepository->getIsLastPage($pageId, $this::ARTCL_NUM);

        $categoryArtclCount = $this->categorySearchListRepository->getCategoryArtclCount();
        $subCategoryArtclCount = $this->categorySearchListRepository->getSubCategoryArtclCount();

        return (new Presenter())->present($pageId, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount);
    }
}