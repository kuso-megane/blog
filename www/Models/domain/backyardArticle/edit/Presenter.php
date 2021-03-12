<?php

namespace domain\backyardArticle\edit;

use domain\backyardArticle\edit\Data\OldArticleContent;

class Presenter
{
    /**
     * @param bool $isNew
     * @param OldArticleContent|NULL $oldArticleContent
     * @param Category[] $categoryList
     * @param SubCategory[] $subCategoryList
     * 
     * @return array [
     *      'isNew' => bool,
     *      'artcl_id' => int|NULL,
     *      'oldC_id' => int|NULL,
     *      'oldSubc_id' => int|NULL,
     *      'oldTitle' => string|NULL,
     *      'oldThumbnailName' => string|NULL,
     *      'oldContent' => string|NULL,
     *      'categoryList' => $this->formatForCategoryList($categoryList),
     *      'subCategoryList' => $this->formatForSubCategoryList($subCategoryList)
     * ]
     */
    public function present(bool $isNew, ?OldArticleContent $oldArticleContent,
    array $categoryList, array $subCategoryList):array
    {

        $oldArticleContent = ($oldArticleContent != NULL) ? $oldArticleContent->toArray() : [];

        $artcl_id = $oldArticleContent['id'];
        $oldC_id = $oldArticleContent['c_id'];
        $oldSubc_id = $oldArticleContent['subc_id'];
        $oldTitle = $oldArticleContent['title'];
        $oldThumbnailName = $oldArticleContent['thumbnailname'];
        $oldContent = $oldArticleContent['content'];

        return [
            'isNew' => $isNew,
            'artcl_id' => $artcl_id,
            'oldC_id' => $oldC_id,
            'oldSubc_id' => $oldSubc_id,
            'oldTitle' => $oldTitle,
            'oldThumbnailName' => $oldThumbnailName,
            'oldContent' => $oldContent,
            'categoryList' => $this->formatForCategoryList($categoryList),
            'subCategoryList' => $this->formatForSubCategoryList($subCategoryList)
        ];
    }


    /**
     * @param Category[] $categoryList
     * 
     * return [
     *      ['id' => int, 'name' => string],
     *      []
     * ]
     */
    private function formatForCategoryList(array $categoryList):array
    {
        foreach($categoryList as &$category) {
            $category = $category->toArray();
        }

        return $categoryList;
    }


    /**
     * @param SubCategory[] $subCategoryList
     * 
     * @return [
     *      c_id1 => [
     *              ['id' => int, 'name' => string],
     *              []
     *          ],
     * 
     *      c_id2 => []
     * ]
     */
    private function formatForSubCategoryList(array $subCategoryList):array
    {
        $arr = [];
        foreach($subCategoryList as $subCategory) {
            $subCategory = $subCategory->toArray();

            if ($arr[$subCategory['c_id']] == NULL) {
                $arr[$subCategory['c_id']] = [];
            }
            
            array_push($arr[$subCategory['c_id']], ['id' => $subCategory['id'], 'name' => $subCategory['name']]);
        }

        return $arr;
    }
}
