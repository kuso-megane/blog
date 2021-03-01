<?php

namespace domain\components\mainSideBar\Data;

class SubCategoryArtclCount
{
    private $c_id;
    private $id;
    private $subCategory;
    private $count;


    public function __construct(int $c_id, int $id, string $subCategory, int $count)
    {
        $this->c_id = $c_id;
        $this->id = $id;
        $this->subCategory = $subCategory;
        $this->count = $count;
    }


    public function toArray():array
    {
        return [
            'c_id' => $this->c_id,
            'id' => $this->id,
            'name' => $this->subCategory,
            'count' => $this->count
        ];
    }
}
