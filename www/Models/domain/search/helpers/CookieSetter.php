<?php

namespace domain\search\helpers;

use myapp\myFrameWork\SuperGlobalVars;

class CookieSetter
{
    public function set(array $input)
    {
        $searched_word = $input['searched_word'];

        $cookie = (new SuperGlobalVars)->getCookie();
        /*
        // すでにsearched_wordがcookieに設定されている場合は削除
        if ($cookie['searched_word' != NULL]) {
            setcookie('searched_word', "", [
                'expires' => time() - 3600
            ]);
        }
        */
        setcookie('searched_word', $searched_word, [
            'expires' => time() + 3600
        ]);
    }
}