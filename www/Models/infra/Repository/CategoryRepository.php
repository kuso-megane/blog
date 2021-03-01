<?php

namespace infra\Repository;

use domain\components\mainSidebar\Data\CategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use infra\database\src\CategoryTable;

class CategoryRepository implements CategoryArtclCountRepositoryPort
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

}