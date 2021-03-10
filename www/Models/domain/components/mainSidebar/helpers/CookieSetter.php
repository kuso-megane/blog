<?php

namespace domain\components\mainSidebar\helpers;

use myapp\myFrameWork\SuperGlobalVars;

class CookieSetter
{
    public function set(?string $searched_word)
    {
        if ($searched_word != NULL) {
            setcookie('searched_word', $searched_word, [
                'expires' => time() + 600
            ]);
        } 
    }
}