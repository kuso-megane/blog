<?php

namespace infra\Repository;

use domain\components\breadCrumb\Data\SearchedCategory;
use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\mainSidebar\Data\CategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use infra\database\src\CategoryTable;

class CategoryRepository implements CategoryArtclCountRepositoryPort, SearchedCategoryRepositoryPort
{

    private $table;

    public function __construct()
    {
        $this->table = new CategoryTable();
    }


    /**
     * @inheritdoc
     */
    public function getCategoryArtclCount(): array
    {
        $ans = [];

        $datas = $this->table->findAll();
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
    public function getSearchedCategory(int $searched_c_id): ?SearchedCategory
    {
        
        if ($searched_c_id == NULL) {
            return NULL;
        }
        else {
            $record = $this->table->findById($searched_c_id);
            $name = $record['name'];
            return new SearchedCategory($searched_c_id, $name);
        }
    }

}