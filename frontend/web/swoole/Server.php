<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/17 14:47
 */
$test = null;
$ws = new swoole_websocket_server("0.0.0.0", 9501);
$ws->set([
    'heartbeat_check_interval'=>5,
    'heartbeat_idle_time'=>600
]);
$ws->on('request', function($request, $response) {
    include '../index.php';
    var_dump($request->get, $response);
});
//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame)  use ($test){
    echo "Message: {$frame->data}\n";
    $test = $frame->data;
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();