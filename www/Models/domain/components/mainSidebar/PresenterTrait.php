<?php

namespace domain\components\mainSidebar;

trait PresenterTrait
{
    /**
     * formatter for categoryArtclCount
     * @param array of Data\CategoryArtclCount $categoryArtclCount
     * 
     * @return array ['category1' => int, 'category2' => int, ]
     */ 
    private function formatForCAC($categoryArtclCount):array
    {
        $arr = [];
        foreach ($categoryArtclCount as $cacData) {
            $cac = $cacData->toArray();
            $arr[$cac['category']] = $cac['count'];
        }

        return $arr;
    }


    /**
     * formatter for subCategoryArtclCount
     * @param array of Data\SubCategoryArtclCount $subCategoryArtclCount
     * 
     * @return array [
     *      'category1' => ['subCategory1' => int, 'subCategory2' => int, ],
     *      'category2' => [], 
     * ]
     */
    private function formatForSCAC($subCategoryArtclCount):array
    {
        $arr = [];
        foreach ($subCategoryArtclCount as $scacData) {
            $scac = $scacData->toArray();
            if ($arr[$scac['category']] == NULL) {
                $arr[$scac['category']] = [];
            }
            $arr[$scac['category']] += [$scac['subCategory'] => $scac['count']];
        }

        return $arr;
    }
}