<?php

namespace infra\Repository;

use domain\components\mainSidebar\RepositoryPort\CategorySearchListRepositoryPort;
use domain\components\mainSidebar\Data\CategoryArtclCount;
use domain\components\mainSidebar\Data\SubCategoryArtclCount;
use infra\database\src\CategoryTable;
use infra\database\src\SubCategoryTable;

class CategorySearchListRepository implements CategorySearchListRepositoryPort
{

    /**
     * @inheritdoc
     */
    public function getCategoryArtclCount(): array
    {
        $ans = [];

        $datas = (new CategoryTable())->findAll();
        foreach($datas as $data) {
            $category = $data['name'];
            $count = $data['num'];
            array_push($ans, new CategoryArtclCount($category, $count));
        }
        
        return $ans;
    }


    /**
     * @inheritdoc
     */
    public function getSubCategoryArtclCount(): array
    {
        $ans = [];

        $datas = (new SubCategoryTable())->findAll();
        foreach($datas as $data) {
            $c_id = $data['c_id'];
            $category = (new CategoryTable())->findById($c_id)['name'];
            $subCategory = $data['name'];
            $count = $data['num'];
            array_push($ans, new SubCategoryArtclCount($category, $subCategory, $count));
        }

        return $ans;
    }
}