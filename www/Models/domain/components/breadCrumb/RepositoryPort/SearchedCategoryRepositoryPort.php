<?php

namespace domain\components\breadCrumb\RepositoryPort;

use domain\components\breadCrumb\Data\SearchedCategory;

interface SearchedCategoryRepositoryPort
{

    /**
     * @param array $input
     * 
     * @return SearchedCategory|NULL
     */
    public function getSearchedCategory(array $input):?SearchedCategory;
}
