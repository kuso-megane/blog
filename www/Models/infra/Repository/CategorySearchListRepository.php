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
            $id = $data['id'];
            $category = $data['name'];
            $count = $data['num'];
            array_push($ans, new CategoryArtclCount($id,$category, $count));
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
            $id = $data['id'];
            $subCategory = $data['name'];
            $count = $data['num'];
            array_push($ans, new SubCategoryArtclCount($c_id, $id, $subCategory, $count));
        }

        return $ans;
    }
}