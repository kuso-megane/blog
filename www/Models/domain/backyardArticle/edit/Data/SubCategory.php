<?php

namespace domain\backyardArticle\edit\Data;

class SubCategory
{
    private $id;
    private $name;
    private $c_id;

    public function __construct(int $id, string $name, int $c_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->c_id = $c_id;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'c_id' => $this->c_id
        ];
    }
}
