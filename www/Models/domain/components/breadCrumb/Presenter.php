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
    public function present(?SearchedCategory $searched_category, ?SearchedSubCategory $searched_subCategory):array
    {
        $searched_category = ($searched_category != NULL) ? $searched_category->toArray() : NULL;
        $searched_subCategory = ($searched_subCategory != NULL) ? $searched_subCategory->toArray() : NULL;
        
        return [
            'searched_category' => $searched_category,
            'searched_subCategory' => $searched_subCategory
        ];
    }
}