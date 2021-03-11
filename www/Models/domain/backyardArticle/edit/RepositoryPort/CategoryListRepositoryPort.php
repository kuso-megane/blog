<?php

namespace domain\backyardArticle\edit\RepositoryPort;

use domain\backyardArticle\edit\Data\Category;

interface CategoryListRepositoryPort
{

    /**
     * 
     * @return Category[]
     */
    public function getCategoryList():array;

}