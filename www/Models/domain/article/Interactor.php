<?php

namespace domain\search;

use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use myapp\config\AppConfig;
use myapp\myFrameWork\SuperGlobalVars as GVars;

class Interactor
{

    private $categoryArtclCountRepositoryPort;
    private $subCategoryArtclCountRepositoryPort;
    private $searchedCategoryRepository;
    private $searchedSubCategoryRepository;

    
    public function __construct(

        CategoryArtclCountRepositoryPort $categoryArtclCountRepositoryPort,
        SubCategoryArtclCountRepositoryPort $subCategoryArtclCountRepositoryPort,
        SearchedCategoryRepositoryPort $searchedCategoryRepository,
        SearchedSubCategoryRepositoryPort $searchedSubCategoryRepository
    )
    {
        
        $this->categoryArtclCountRepositoryPort = $categoryArtclCountRepositoryPort;
        $this->subCategoryArtclCountRepositoryPort = $subCategoryArtclCountRepositoryPort;
        $this->searchedCategoryRepository = $searchedCategoryRepository;
        $this->searchedSubCategoryRepository = $searchedSubCategoryRepository;
    }
    


    /**
     * @param array $var
     * 
     * @return array
     */
    public function interact(array $vars):array
    {
        $artclNum = (new AppConfig)::ARTCL_NUM;

        $input = (new Validator)->validate($vars)->toArray();

        

        

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

        //現在のurl
        $server = (new Gvars)->getServer();
        $uri = $server['REQUEST_URI'];
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $currentUrl = rawurldecode($uri);

        return (new Presenter())
        ->present($input, $currentUrl,  $categoryArtclCount, $subCategoryArtclCount,
        $searchedCategory, $searchedSubCategory);
    }
}
