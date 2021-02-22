<?php

namespace domain\category\index;


class Presenter
{

    /**
     * @param array $recentArtclInfos array of Data\ArtclInfo
     * @param bool $isLastPage
     * 
     * refer to components/mainSidebar
     * @param array $categoryArtclCount 
     * @param array $subCategoryArtclCount 
     * 
     * @return array 
     */
    public function present(array $recentArtclInfos, bool $isLastPage, array $categoryArtclCount, array $subCategoryArtclCount)
    {
        return [
            'recentArtclInfos' => $this->formatForRAI($recentArtclInfos),
            'isLastPage' => $isLastPage,
            'categoryArtclCount' => $f->objectsArrTo2DArr($categoryArtclCount),
            'subCategoryArtclCount' => $f->objectsArrTo2DArr($subCategoryArtclCount)
        ];
    }


    /**
     * formatter for recentArtclInfo
     * @param array $recentArtclInfos
     * 
     * @return array [
     *      ['id' => int, 'title' => string, 'updateDate' => string, 'thumbnailName' => string, 'c_id' => int, 'subc_id' => int],
     * ]
     */ 
    private function formatForRAI(array $recentArtclInfos):array
    {
        foreach($recentArtclInfos as &$object) {
            $object = $object->toArray();
        }

        return $recentArtclInfos;
    }
}


