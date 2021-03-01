<?php 

namespace domain\search\index\Data;


class InputData
{
    private  $pageId;


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
