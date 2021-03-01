<?php

namespace domain\components\mainSidebar\RepositoryPort;

use domain\components\mainSideBar\data\CategoryArtclCount;
use domain\components\mainSideBar\Data\SubCategoryArtclCount;

interface CategorySearchListRepositoryPort
{

    /**
     * @return array of CategoryArtclCount
     */
    public function getCategoryArtclCount():array;


    /**
     * @return array of SubCategoryArtclCount
     */
    public function getSubCategoryArtclCount():array;

}