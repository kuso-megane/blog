<?php

namespace domain\components\mainSidebar\RepositoryPort;

use domain\components\mainSideBar\data\CategoryArtclCount;
use domain\components\mainSideBar\Data\SubCategoryArtclCount;

interface CategoryArtclCountRepositoryPort
{

    /**
     * @return CategoryArtclCount[]
     */
    public function getCategoryArtclCount():array;

}