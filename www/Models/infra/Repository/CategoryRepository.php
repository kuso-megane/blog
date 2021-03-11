<?php

namespace infra\Repository;

use domain\backyardArticle\edit\Data\Category;
use domain\backyardArticle\edit\RepositoryPort\CategoryListRepositoryPort;
use domain\components\breadCrumb\Data\SearchedCategory;
use domain\components\breadCrumb\RepositoryPort\SearchedCategoryRepositoryPort;
use domain\components\mainSidebar\Data\CategoryArtclCount;
use domain\components\mainSidebar\RepositoryPort\CategoryArtclCountRepositoryPort;
use infra\database\src\CategoryTable;

class CategoryRepository
implements CategoryArtclCountRepositoryPort,
SearchedCategoryRepositoryPort,
CategoryListRepositoryPort
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
        $record = $this->table->findById($searched_c_id);
        if ($record == NULL) {
            return NULL;
        }
        else { 
            $name = $record['name'];
            return new SearchedCategory($searched_c_id, $name);
        }
    }

    
    /**
     * @inheritDoc
     */
    public function getCategoryList(): array
    {
        $ans = [];

        $datas = $this->table->findAll();
        foreach($datas as $data) {
            $id = $data['id'];
            $category = $data['name'];
            array_push($ans, new Category($id, $category));
        }
        
        return $ans;
    }

}