<?php

namespace infra\Repository;

use domain\backyardArticle\edit\RepositoryPort\SubCategoryListRepositoryPort;
use domain\components\breadCrumb\Data\SearchedSubCategory;
use domain\components\breadCrumb\RepositoryPort\SearchedSubCategoryRepositoryPort;
use domain\components\mainSidebar\Data\SubCategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\SubCategoryArtclCountRepositoryPort;
use infra\database\src\SubCategoryTable;
use domain\backyardArticle\edit\Data\SubCategory;

class SubCategoryRepository
implements SubCategoryArtclCountRepositoryPort,
SearchedSubCategoryRepositoryPort,
SubCategoryListRepositoryPort
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
        $record = $this->table->findById($searched_subc_id);
        if ($record == NULL) {
            return NULL;
        }
        else {
            $name = $record['name'];
            return new SearchedSubCategory($searched_subc_id, $name);
        }
    }


    /**
     * @inheritDoc
     */
    public function getSubCategoryList(): array
    {
        $ans = [];

        $datas = $this->table->findAll();
        foreach($datas as $data) {
            $id = $data['id'];
            $category = $data['name'];
            $c_id = $data['c_id'];
            array_push($ans, new SubCategory($id,$category, $c_id));
        }
        
        return $ans;
    }
}
