<?php

namespace domain\components\breadCrumb\Data;

class SearchedCategory
{
    private $id;
    private $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}