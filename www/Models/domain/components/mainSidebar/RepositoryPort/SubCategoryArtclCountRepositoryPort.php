<?php

namespace domain\components\mainSidebar\RepositoryPort;

use domain\components\mainSideBar\Data\SubCategoryArtclCount;

interface SubCategoryArtclCountRepositoryPort
{

    /**
     * @return SubCategoryArtclCount[]
     */
    public function getSubCategoryArtclCount():array;

}