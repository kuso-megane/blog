<?php

namespace domain\backyardArticle\edit\Data;

class OldArticleContent
{
    private $id;
    private $title;
    private $content;

    public function __construct(int $id, string $title, string $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}
