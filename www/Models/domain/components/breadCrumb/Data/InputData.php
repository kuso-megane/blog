<?php 

namespace domain\components\breadCrumb\Data;


class InputData
{  
    private $c_id;
    private $subc_id;


    public function __construct(?int $c_id, ?int $subc_id)
    {
        $this->c_id = $c_id;
        $this->subc_id = $subc_id;
    }

    public function toArray():array
    {
        return [
            'searched_c_id' => $this->c_id,
            'searched_subc_id' => $this->subc_id
        ];
    }
}
