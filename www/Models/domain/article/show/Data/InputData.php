<?php

namespace domain\article\show\Data;

class InputData
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id
        ];
    }
}