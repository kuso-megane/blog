<?php

namespace domain\search;

use domain\search\RepositoryPort\RecentArtclInfosRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use domain\search\Presenter;
use domain\search\validator\Validator;
use myapp\config\AppConfig;

class Interactor
{

    private $recentArtclInfosRepository;
    private $categoryArtclCountRepositoryPort;
    private $subCategoryArtclCountRepositoryPort;

    
    public function __construct(RecentArtclInfosRepositoryPort $recentArtclInfosRepository,
    CategoryArtclCountRepositoryPort $categoryArtclCountRepositoryPort,
    SubCategoryArtclCountRepositoryPort $subCategoryArtclCountRepositoryPort)
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
        $this->categoryArtclCountRepositoryPort = $categoryArtclCountRepositoryPort;
        $this->subCategoryArtclCountRepositoryPort = $subCategoryArtclCountRepositoryPort;
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

        $categoryArtclCount = $this->categoryArtclCountRepositoryPort->getCategoryArtclCount();
        $subCategoryArtclCount = $this->subCategoryArtclCountRepositoryPort->getSubCategoryArtclCount();

        return (new Presenter())->present($input, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount);
    }
}