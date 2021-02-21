<?php 

namespace domain\category\index\data;


class InputData
{
    public  $pageId;


    public function __construct(int $pageId)
    {
        $this->pageId = $pageId;
    }
}
