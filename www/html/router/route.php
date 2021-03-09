<?php

/*
 * dependent on FastRoute https://github.com/nikic/FastRoute
 */

require_once '../../vendor/autoload.php';
require '../../controllers/callAction/callAction.php';


$base = '/';
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($base) {
    $r->addRoute('GET', $base . 'index', 'index'); //index

    $r->addRoute('GET', $base . 'search[/{c_id:\d+}[/{subc_id:\d+}]]', 'searchResult');
    
    $r->addRoute('GET', $base.'article/{artcl_id:\d+}', 'articleShow');

    $r->addGroup('/backyard', function (FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '/article', 'backyardArticleIndex');
        $r->addRoute('GET', '/article/edit[/{artcl_id:\d+}]', 'backyardArticleEdit');
        $r->addRoute('POST', '/article/post{/artcl_id:\d+}', 'backyardArticlePost');
    });
    
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "ページが見つかりませんでした\n";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // ... 405 Method Not Allowed
        //$allowedMethods = $routeInfo[1];
        echo "許可されていないHTTPリクエストです\n";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        callAction($handler, $vars); // reference to callAction.php
        break;
}

