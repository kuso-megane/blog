<?php 

namespace domain\category\index\Data;


class InputData
{
    public  $pageId;


    public function __construct(int $pageId)
    {
        $this->pageId = $pageId;
    }

    public function toArray()
    {
        return [
            'pageId' => $this->pageId
        ];
    }
}
