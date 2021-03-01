<?php

namespace domain\components\mainSidebar;

trait PresenterTrait
{
    /**
     * formatter for categoryArtclCount
     * @param array of Data\CategoryArtclCount $categoryArtclCount
     * 
     * @return array [
     *      ['id' => int, 'name' => 'Category1', 'count' => int],
     *      []
     * ]
     */ 
    private function formatForCAC($categoryArtclCount):array
    {
        foreach ($categoryArtclCount as &$cacData) {
            $cacData = $cacData->toArray();
        }

        return $categoryArtclCount;
    }


    /**
     * formatter for subCategoryArtclCount
     * @param array of Data\SubCategoryArtclCount $subCategoryArtclCount
     * 
     * @return array [
     *      'c_id1' => [
     *          ['id' => int, 'name' => 'SubCategory1', 'count' => int],
     *          []
     *      ],
     *      'c_id2' => []
     * ]
     */
    private function formatForSCAC($subCategoryArtclCount):array
    {
        $arr = [];
        foreach ($subCategoryArtclCount as $scacData) {
            $scac = $scacData->toArray();
            if ($arr[$scac['c_id']] == NULL) {
                $arr[$scac['c_id']] = [];
            }
            array_push($arr[$scac['c_id']], ['id' => $scac['id'], 'name' => $scac['name'], 'count' => $scac['count']]);
        }

        return $arr;
    }
}