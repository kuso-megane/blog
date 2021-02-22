<?php

namespace domain\components\mainSidebar\RepositoryPort;

use domain\components\mainSideBar\data\CategoryArtclCount;
use domain\components\mainSideBar\Data\SubCategoryArtclCount;

interface CategorySearchListRepositoryPort
{

    /**
     * @return CategoryArtclCount
     */
    public function getCategoryArtclCount():CategoryArtclCount;


    /**
     * @return SubCategoryArtclCount
     */
    public function getSubCategoryArtclCount():SubCategoryArtclCount;

}