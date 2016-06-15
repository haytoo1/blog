<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/15 9:43
 */

// 1. 构建Server对象
$serv = new swoole_server("0.0.0.0", 9501);

// 2. 设置运行时参数
$serv->set(['worker_num'=>4, 'daemonize'=>false]);

// 3. 注册一系列事件回调函数
$serv->on('connect', function(){
    echo 'Connect';
});
$serv->on('receive', function(){
    echo 'receive';
});

// 5. 启动服务器
$serv->start();