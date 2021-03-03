<?php

namespace domain\search;

use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
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
    private $searchedCategoryRepository;
    private $searchedSubCategoryRepository;

    
    public function __construct(
        RecentArtclInfosRepositoryPort $recentArtclInfosRepository,
        CategoryArtclCountRepositoryPort $categoryArtclCountRepositoryPort,
        SubCategoryArtclCountRepositoryPort $subCategoryArtclCountRepositoryPort,
        SearchedCategoryRepositoryPort $searchedCategoryRepository,
        SearchedSubCategoryRepositoryPort $searchedSubCategoryRepository
    )
    {
        $this->recentArtclInfosRepository = $recentArtclInfosRepository;
        $this->categoryArtclCountRepositoryPort = $categoryArtclCountRepositoryPort;
        $this->subCategoryArtclCountRepositoryPort = $subCategoryArtclCountRepositoryPort;
        $this->searchedCategoryRepository = $searchedCategoryRepository;
        $this->searchedSubCategoryRepository = $searchedSubCategoryRepository;
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

        //cookie関連
        //setcookie('word', $input['given_word'],);

        //カテゴリ検索
        $categoryArtclCount = $this->categoryArtclCountRepositoryPort->getCategoryArtclCount();
        $subCategoryArtclCount = $this->subCategoryArtclCountRepositoryPort->getSubCategoryArtclCount();

        //パンクズリスト
        $searchedCategory = $this->searchedCategoryRepository->getSearchedCategory($input);
        if ($searchedCategory != NULL) {
            $searchedCategory = $searchedCategory->toArray();
        }
        $searchedSubCategory = $this->searchedSubCategoryRepository->getSearchedSubCategory($input);
        if ($searchedSubCategory != NULL) {
            $searchedSubCategory = $searchedSubCategory->toArray();
        }

        return (new Presenter())
        ->present($input, $recentArtclInfos, $isLastPage, $categoryArtclCount, $subCategoryArtclCount,
        $searchedCategory, $searchedSubCategory);
    }
}
