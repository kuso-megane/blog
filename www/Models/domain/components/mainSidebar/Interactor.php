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
     * 
     * @return array
     */
    public function interact():array
    {

        $input = (new Validator)->validate()->toArray();
        $searched_word = $input['searched_word'];

        //cookieをセット
        (new CookieSetter)->set($searched_word);

        //カテゴリ検索
        $categoryArtclCount = $this->categoryArtclCountRepositoryPort->getCategoryArtclCount();
        $subCategoryArtclCount = $this->subCategoryArtclCountRepositoryPort->getSubCategoryArtclCount();


        return (new Presenter())->present($input, $categoryArtclCount, $subCategoryArtclCount);
    }
}
