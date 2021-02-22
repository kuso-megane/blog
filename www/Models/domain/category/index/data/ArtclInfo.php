<?php

namespace domain\category\index\data;

class ArtclInfos
{

    private $id;
    private $title;
    private $updateDate;
    private $thumbnailName;
    private $c_id;
    private $subc_id;


    public function __construct(int $id, string $title, string $updateDate, string $thumbnailName, int $c_id, int $subc_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->updateDate = $updateDate;
        $this->thumbnailName = $thumbnailName;
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'updateDate' => $this->updateDate,
            'thumbnailName' => $this->thumbnailName,
            'c_id' => $this->c_id,
            'subc_id' => $this->subc_id
        ];
    }
}