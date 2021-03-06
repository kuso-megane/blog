<?php

namespace domain\components\mainSidebar;

use domain\components\mainSideBar\Data\CategoryArtclCount;
use domain\components\mainSideBar\Data\SubCategoryArtclCount;


class Presenter
{   

    /**
     * @param string|NULL $searchBoxValue
     * @param CategoryArtclCount[] $categoryArtclCount
     * @param SubCategoryArtclCount[] $subCategoryArtclCount
     * 
     * @return array [
     *      'categoryArtclCount' => return of $this->formatForCAC(),
     *      'subCategoryArtclCount' => return of $this->formatForSCAC()   ,
     *      'searchBoxValue' => string
     * ]
     */
    public function present(?string $searchBoxValue, array  $categoryArtclCount, array $subCategoryArtclCount):array
    {
        

        return [
            'categoryArtclCount' => $this->formatForCAC($categoryArtclCount),
            'subCategoryArtclCount' => $this->formatForSCAC($subCategoryArtclCount),
            'searchBoxValue' => $searchBoxValue
        ];
    }

    /**
     * formatter for categoryArtclCount
     * @param CategoryArtclCount[] $categoryArtclCount
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
     * @param SubCategoryArtclCount[] $subCategoryArtclCount
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
