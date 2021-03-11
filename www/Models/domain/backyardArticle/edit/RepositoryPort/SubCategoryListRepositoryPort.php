<?php

namespace domain\backyardArticle\edit\RepositoryPort;

use domain\backyardArticle\edit\Data\SubCategory;

interface SubCategoryListRepositoryPort
{

    /**
     * 
     * @return SubCategory[]
     */
    public function getSubCategoryList():array;

}