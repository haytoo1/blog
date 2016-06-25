<?php

/**
 * Created by PhpStorm.
 * Date: 16/6/25
 * Time: 21:37
 * @author 涂鸿 <hayto@foxmail.com>
 */

$server = new swoole_server('0.0.0.0', 9501);

/*
 * $fd是连接的描述符,多个连接时可以区分是哪个连接
 * */
// 建立连接触发
$server->on('connect', function(swoole_server $serv, $fd, $from_id){
    echo "Connected\n";
    $serv->send($fd, 'hello');
});

// 收到数据触发
$server->on('receive', function(swoole_server $serv, $fd, $from_id, $data){
    echo "Receive: {$data}\n";


    $serv->send($fd, "Server: {$data}");
});

// 断开连接触发
$server->on('close', function(swoole_server $serv, $fd, $from_id){
    echo "Close\n";
});

$server->start();