<?php

namespace domain\components\mainSideBar\Data;

class CategoryArtclCount
{
    private $id;
    private $category;
    private $count;


    public function __construct(int $id, string $category, int $count)
    {
        $this->id = $id;
        $this->category = $category;
        $this->count = $count;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'name' => $this->category,
            'count' => $this->count
        ];
    }
}
