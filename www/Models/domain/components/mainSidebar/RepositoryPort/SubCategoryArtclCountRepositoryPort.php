<?php

namespace domain\components\mainSidebar\RepositoryPort;

use domain\components\mainSideBar\Data\SubCategoryArtclCount;

interface SubCategoryArtclCountRepositoryPort
{

    /**
     * @return array of SubCategoryArtclCount
     */
    public function getSubCategoryArtclCount():array;

}