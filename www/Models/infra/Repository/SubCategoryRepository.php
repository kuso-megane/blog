<?php

namespace infra\Repository;

use domain\components\mainSidebar\Data\SubCategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use infra\database\src\SubCategoryTable;

class SubCategoryRepository implements SubCategoryArtclCountRepositoryPort
{
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