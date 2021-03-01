<?php

// routerからcontrollerへ繋ぐ

use myapp\Controllers\articleController as Article;
use myapp\Controllers\BackyardController as Backyard;
use myapp\Controllers\SearchController as Search;

/**
 * @param string $handler
 * @param array|NULL $vars  e.g. ['c_id' => 4, 'subc-id' => 7]
 *
 * @return void
 */
function callAction (string $handler, ?array $vars = NULL)
{
    if ($handler == 'index') {

        $controller = new Search;
        $controller->index($vars);
        
    }
    elseif ($handler == 'searchResult') {

        $controller = new Search;
        $controller->result($vars);

    }
    elseif ($handler == 'articleShow') {

        $controller = new Article;
        $controller->show($vars);
        
    }
    elseif ($handler == 'backyardIndex') {

        $controller = new Backyard;
        $controller->index($vars);

    }
    elseif ($handler == 'backyardEdit') {

        $controller = new Backyard;
        $controller->edit($vars);

    }
    elseif ($handler == 'backyardCreate') {

        $controller = new Backyard;
        $controller->create($vars);

    }
    elseif ($handler == 'backyardUpdate') {
        
        $controller = new Backyard;
        $controller->update($vars);

    }
}