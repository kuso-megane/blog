<?php

namespace domain\components\breadCrumb;

use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\breadCrumb\Presenter;
use domain\components\breadCrumb\validator\Validator;
use domain\Exception\ValidationFailException;
use myapp\config\AppConfig;

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
     * @return array|int
     * 
     * if validation fails, this returns ValidationFailException
     */
    public function interact(?array $vars = NULL)
    {

        try {
            $input = (new Validator)->validate($vars)->toArray();
        }
        catch (ValidationFailException $e) {
            return $e;
        } 
        

        $searched_c_id = $input['searched_c_id'];
        $searched_subc_id = $input['searched_subc_id'];

        if ($searched_c_id == NULL) {
            $searchedCategory = NULL;
        }
        else {
            $searchedCategory = $this->searchedCategoryRepository->getSearchedCategory($searched_c_id);
        }

        if ($searched_subc_id == NULL) {
            $searchedCategory = NULL;
        }
        else {
            $searchedSubCategory = $this->searchedSubCategoryRepository->getSearchedSubCategory($searched_subc_id);
        }

        return (new Presenter())->present($searchedCategory, $searchedSubCategory);
    }
}
