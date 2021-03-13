<?php

namespace domain\backyardArticle\post\Data;

class InputData
{
    private $artcl_id;
    private $c_id;
    private $subc_id;
    private $title;
    private $thumbnailName;
    private $content;

    /**
     * @param int|NULL $artcl_id
     * @param int $c_id
     * @param int $subc_id
     * @param string $title
     * @param string|NULL $thumbnailName
     * @param string $content
     */
    public function __construct(?int $artcl_id, int $c_id, int $subc_id, string $title,
    ?string $thumbnailName, string $content)
    {
        $this->artcl_id = $artcl_id;
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
        $this->title = $title;
        $this->thumbnailName = $thumbnailName;
        $this->content = $content;
    }


    public function toArray():array
    {
        return [
            'artcl_id' => $this->artcl_id,
            'c_id' => $this->c_id,
            'subc_id' => $this->subc_id,
            'title' => $this->title,
            'thumbnailName' => $this->thumbnailName,
            'content' => $this->content
        ];
    }
}
