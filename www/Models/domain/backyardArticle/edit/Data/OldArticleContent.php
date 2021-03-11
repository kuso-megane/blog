<?php

namespace domain\backyardArticle\edit\Data;

class OldArticleContent
{
    private $id;
    private $c_id;
    private $subc_id;
    private $title;
    private $thumbnailName;
    private $content;

    public function __construct(int $id, int $c_id, int $subc_id, string $title, string $thumbnailName, string $content)
    {
        $this->id = $id;
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
        $this->title = $title;
        $this->thumbnailName = $thumbnailName;
        $this->content = $content;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'c_id' => $this->c_id,
            'subc_id' => $this->subc_id,
            'title' => $this->title,
            'thumbnailName' => $this->thumbnailName,
            'content' => $this->content
        ];
    }
}
