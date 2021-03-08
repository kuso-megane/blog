<?php

namespace domain\components\mainSidebar\helpers;

use myapp\myFrameWork\SuperGlobalVars;

class CookieSetter
{
    public function set(string $searched_word)
    {
        
        setcookie('searched_word', $searched_word, [
            'expires' => time() + 600
        ]);
    }
}