<?php

namespace domain\components\mainSidebar;

use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\helpers\CookieSetter;
use domain\components\mainSidebar\Presenter;
use domain\components\mainSidebar\validator\Validator;
use domain\Exception\ValidationFailException;
use myapp\myFrameWork\SuperGlobalVars as GVars;

class Interactor
{

    private $categoryArtclCountRepositoryPort;
    private $subCategoryArtclCountRepositoryPort;

    
    public function __construct(
        CategoryArtclCountRepositoryPort $categoryArtclCountRepositoryPort,
        SubCategoryArtclCountRepositoryPort $subCategoryArtclCountRepositoryPort
    )
    {
        $this->categoryArtclCountRepositoryPort = $categoryArtclCountRepositoryPort;
        $this->subCategoryArtclCountRepositoryPort = $subCategoryArtclCountRepositoryPort;
    }
    


    /**
     * 
     * @return array|int
     * if validation fails, this throws ValidationFailException
     */
    public function interact()
    {

        try {
            $input = (new Validator)->validate()->toArray();
        }
        catch (ValidationFailException $e) {
            throw $e;
            return [];
        }
        

        $searched_word = $input['searched_word'];

        //cookieをセット
        (new CookieSetter)->set($searched_word);

        //カテゴリ検索
        $categoryArtclCount = $this->categoryArtclCountRepositoryPort->getCategoryArtclCount();
        $subCategoryArtclCount = $this->subCategoryArtclCountRepositoryPort->getSubCategoryArtclCount();

        $cookie = (new Gvars)->getCookie();
        $searchBoxValue = ($searched_word != NULL) ? $searched_word : $cookie['searched_word'];

        return (new Presenter())->present($searchBoxValue, $categoryArtclCount, $subCategoryArtclCount);
    }
}
