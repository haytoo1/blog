<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/17 14:47
 */

$server = new swoole_server('0.0.0.0', 9501);
$server->on('start', function($serv){
    echo "我是start-1\n";
});

$server->on('managerStart', function(){
    echo "我是managerStart-1\n";
});

$server->on('workerstart', function(){
    echo "我是workerstart-2\n";
});

$server->on('connect', function(){
    echo "我是connect-3\n";
});

$server->on('receive', function(){
    echo "我是receive-4\n";
});

$server->on('shutdown', function(){
    echo "我是shutdown-4\n";
});
$server->start();