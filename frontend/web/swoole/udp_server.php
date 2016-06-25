<?php
/**
 * Created by PhpStorm.
 * Date: 16/6/25
 * Time: 22:47
 * @author 涂鸿 <hayto@foxmail.com>
 */

$server = new swoole_server('127.0.0.1', 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$server->set(['dispatch_mode'=>2]);

$server->on('receive', function(swoole_server $serv, $fd, $from_id, $data){
    echo "{$data}";
    var_dump($serv->connection_info($fd, $from_id));
    $serv->send($fd, "Swoole: {$data}", $from_id);
});

$server->start();