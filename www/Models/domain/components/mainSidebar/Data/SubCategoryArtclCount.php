<?php

namespace domain\components\mainSideBar\Data;

class SubCategoryArtclCount
{
    private $category;
    private $subCategory;
    private $count;


    public function __construct(string $category, string $subCategory, int $count)
    {
        $this->category = $category;
        $this->subCategory = $subCategory;
        $this->count = $count;
    }


    public function toArray():array
    {
        return [
            'category' => $this->category,
            'subCategory' => $this->subCategory,
            'count' => $this->count
        ];
    }
}
