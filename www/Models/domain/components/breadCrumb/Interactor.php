<?php

namespace domain\components\breadCrumb;

use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\breadCrumb\Presenter;
use domain\components\breadCrumb\validator\Validator;

class Interactor
{

    private $searchedCategoryRepository;
    private $searchedSubCategoryRepository;

    
    public function __construct(
        SearchedCategoryRepositoryPort $searchedCategoryRepository,
        SearchedSubCategoryRepositoryPort $searchedSubCategoryRepository
    )
    {
        $this->searchedCategoryRepository = $searchedCategoryRepository;
        $this->searchedSubCategoryRepository = $searchedSubCategoryRepository;
    }
    


    /**
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $vars = NULL):array
    {

        $input = (new Validator)->validate($vars)->toArray();

        $searchedCategory = $this->searchedCategoryRepository->getSearchedCategory($input);
        if ($searchedCategory != NULL) {
            $searchedCategory = $searchedCategory->toArray();
        }
        $searchedSubCategory = $this->searchedSubCategoryRepository->getSearchedSubCategory($input);
        if ($searchedSubCategory != NULL) {
            $searchedSubCategory = $searchedSubCategory->toArray();
        }


        return (new Presenter())->present($searchedCategory, $searchedSubCategory);
    }
}
