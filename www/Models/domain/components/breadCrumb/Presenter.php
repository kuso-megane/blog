<?php

namespace domain\components\breadCrumb;

use domain\components\breadCrumb\Data\SearchedCategory;
use domain\components\breadCrumb\Data\SearchedSubCategory;

class Presenter
{
    /**
     * @param SearchedCategory[]|NULL $searched_category
     * @param SearchedSubCategory[]|NULL $searched_subCategory
     * 
     * @return array [
     *      'searched_category' =>  NULL|array ['id' => int, 'name' -> string],
     *      'searched_subCategory' => NULL|array ['id' => int, 'name' -> string]
     * ]
     * 
     */
    public function present(?array $searched_category, ?array $searched_subCategory):array
    {
        
        return [
            'searched_category' => $searched_category,
            'searched_subCategory' => $searched_subCategory
        ];
    }
}