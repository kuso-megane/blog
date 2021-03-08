<?php

namespace domain\components\breadCrumb\RepositoryPort;

use domain\components\breadCrumb\Data\SearchedSubCategory;

interface SearchedSubCategoryRepositoryPort
{

    /**
     * @param int $searched_subc_id
     * 
     * @return SearchedSubCategory|NULL
     */
    public function getSearchedSubCategory(int $searched_subc_id):?SearchedSubCategory;
}
