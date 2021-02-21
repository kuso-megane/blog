<?php

namespace domain\category\index\data;

class ArtclInfos
{

    private $id;
    private $title;
    private $updateDate;
    private $thumbnailName;


    public function __construct(int $id, string $title, string $updateDate, string $thumbnailName)
    {
        $this->id = $id;
        $this->title = $title;
        $this->updateDate = $updateDate;
        $this->thumbnailName = $thumbnailName;
    }


    public function toArray():array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'updateDate' => $this->updateDate,
            'thumbnailName' => $this->thumbnailName
        ];
    }
}