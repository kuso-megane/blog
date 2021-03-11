<?php

namespace domain\backyard\post\Data;

class InputData
{
    private $artcl_id;
    private $title;
    private $content;

    /**
     * @param int $artcl_id
     * @param string $title
     * @param string $content
     */
    public function __construct(int $artcl_id, string $title, string $content)
    {
        $this->artcl_id = $artcl_id;
        $this->title = $title;
        $this->content = $content;
    }


    public function toArray():array
    {
        return [
            'artcl_id' => $this->artcl_id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}
