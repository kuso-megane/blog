<?php

namespace infra\Repository;

use domain\components\breadCrumb\Data\SearchedSubCategory;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\mainSidebar\Data\SubCategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use infra\database\src\SubCategoryTable;

class SubCategoryRepository implements SubCategoryArtclCountRepositoryPort, SearchedSubCategoryRepositoryPort
{

    public function __construct()
    {
        $this->table = new SubCategoryTable();
    }


    /**
     * @inheritdoc
     */
    public function getSubCategoryArtclCount(): array
    {
        $ans = [];

        $datas = $this->table->findAll();
        foreach($datas as $data) {
            $c_id = $data['c_id'];
            $id = $data['id'];
            $subCategory = $data['name'];
            $count = $data['num'];
            array_push($ans, new SubCategoryArtclCount($c_id, $id, $subCategory, $count));
        }

        return $ans;
    }


    /**
     * @inheritdoc
     */
    public function getSearchedSubCategory(int $searched_subc_id): ?SearchedSubCategory
    {
        
        if ($searched_subc_id == NULL) {
            return NULL;
        }
        else {
            $record = $this->table->findById($searched_subc_id);
            $name = $record['name'];
            return new SearchedSubCategory($searched_subc_id, $name);
        }
    }
}