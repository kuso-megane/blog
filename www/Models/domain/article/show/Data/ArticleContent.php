<?php

namespace domain\article\show\Data;

class ArticleContent
{
    private $c_id;
    private $subc_id;
    private $title;
    private $content;
    private $updateDate;


    public function __construct(int $c_id, int $subc_id, string $title, string $content, string $updateDate)
    {
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
        $this->title = $title;
        $this->content = $content;
        $this->updateDate = $updateDate;
    }

    
    public function toArray():array
    {
        return [
            'c_id' => $this->c_id,
            'subc_id' => $this->subc_id,
            'title' => $this->title,
            'content' => $this->content,
            'updateDate' => $this->updateDate
        ];
    }
}