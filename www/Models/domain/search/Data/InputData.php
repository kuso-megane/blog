<?php 

namespace domain\search\Data;


class InputData
{
    private $pageId;
    private $c_id;
    private $subc_id;
    private $word;


    public function __construct(int $pageId, ?int $c_id, ?int $subc_id, ?string $word)
    {
        $this->pageId = $pageId;
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
        $this->word = $word;
    }

    public function toArray():array
    {
        return [
            'pageId' => $this->pageId,
            'given_c_id' => $this->c_id,
            'given_subc_id' => $this->subc_id,
            'given_word' => $this->word
        ];
    }
}
