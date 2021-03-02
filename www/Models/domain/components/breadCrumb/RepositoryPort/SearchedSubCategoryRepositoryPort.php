<?php

namespace domain\components\breadCrumb\RepositoryPort;

use domain\components\breadCrumb\Data\SearchedSubCategory;

interface SearchedSubCategoryRepositoryPort
{

    /**
     * @param array $input
     * 
     * @return SearchedSubCategory|NULL
     */
    public function getSearchedSubCategory(array $input):?SearchedSubCategory;
}
