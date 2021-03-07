<?php

namespace domain\components\mainSideBar\Data;

class InputData
{
    private $word;


    public function __construct(?string $word)
    {
        $this->word = $word;
    }

    public function toArray():array
    {
        return [
            'searched_word' => $this->word
        ];
    }
}