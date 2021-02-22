<?php

namespace domain\components\mainSideBar\Data;

class CategoryArtclCount
{
    private $category;
    private $count;


    public function __construct(string $category, int $count)
    {
        $this->category = $category;
        $this->count = $count;
    }


    public function toArray():array
    {
        return [
            'category' => $this->category,
            'count' => $this->count
        ];
    }
}
