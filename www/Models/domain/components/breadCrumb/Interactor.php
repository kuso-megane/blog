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

        $searched_c_id = $input['searched_c_id'];
        $searched_subc_id = $input['searched_subc_id'];

        $searchedCategory = $this->searchedCategoryRepository->getSearchedCategory($searched_c_id);
        if ($searchedCategory != NULL) {
            $searchedCategory = $searchedCategory->toArray();
        }
        $searchedSubCategory = $this->searchedSubCategoryRepository->getSearchedSubCategory($searched_subc_id);
        if ($searchedSubCategory != NULL) {
            $searchedSubCategory = $searchedSubCategory->toArray();
        }


        return (new Presenter())->present($searchedCategory, $searchedSubCategory);
    }
}
