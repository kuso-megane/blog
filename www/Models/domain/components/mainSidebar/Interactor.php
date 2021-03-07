<?php

namespace domain\components\mainSidebar;

use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use domain\components\mainSidebar\helpers\CookieSetter;
use domain\components\mainSidebar\Presenter;
use domain\components\mainSidebar\validator\Validator;

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
     * @param array|NULL $var
     * 
     * @return array
     */
    public function interact(?array $vars = NULL):array
    {

        $input = (new Validator)->validate($vars)->toArray();

        //cookieをセット
        (new CookieSetter)->set($input);

        //カテゴリ検索
        $categoryArtclCount = $this->categoryArtclCountRepositoryPort->getCategoryArtclCount();
        $subCategoryArtclCount = $this->subCategoryArtclCountRepositoryPort->getSubCategoryArtclCount();


        return (new Presenter())->present($input, $categoryArtclCount, $subCategoryArtclCount);
    }
}
