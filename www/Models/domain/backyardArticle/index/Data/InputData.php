<?php

namespace domain\backyardArticle\index\Data;

class InputData
{
    private $searched_word;

    public function __construct(?string $word)
    {
        $this->searched_word = $word;
    }


    public function toArray():array
    {
        return [
            'searched_word' => $this->searched_word
        ];
    }
}
