<?php
/**
 * Created by PhpStorm.
 * Date: 16/6/25
 * Time: 22:10
 * @author 涂鸿 <hayto@foxmail.com>
 */


$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);


$client->on('connect', function(swoole_client $cli){
    echo "connect\n";
});

$client->on('error', function(swoole_client $cli){
    echo "connect Fail\n";
});

$client->on('receive', function(swoole_client $cli, $data){
    echo "receive: {$data} \n";
    sleep(1);
    $cli->send('yoyo');
});

$client->on('close', function(swoole_client $cli){
    echo "close\n";
});

$client->connect('127.0.0.2', 9501);

