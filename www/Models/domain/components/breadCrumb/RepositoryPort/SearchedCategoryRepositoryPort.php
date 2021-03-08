<?php

namespace domain\components\breadCrumb\RepositoryPort;

use domain\components\breadCrumb\Data\SearchedCategory;

interface SearchedCategoryRepositoryPort
{

    /**
     * @param int $searched_c_id
     * 
     * @return SearchedCategory|NULL
     */
    public function getSearchedCategory(int $searched_c_id):?SearchedCategory;
}
