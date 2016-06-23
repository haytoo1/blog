<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/17 14:47
 */
$serv = new swoole_http_server("127.0.0.1", 9501);
$serv->set([
    'worker_num'=>2,
    'max_request'=>1000
]);
$serv->on('Request', function($request, $response) {
    var_dump($request);

    $response->cookie("User", "Swoole");
    $response->header("X-Server", "Swoole");
    $response->end("<h1>Hello Swoole!</h1>");
});

$serv->start();