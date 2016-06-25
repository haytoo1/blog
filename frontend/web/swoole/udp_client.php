<?php
/**
 * Created by PhpStorm.
 * Date: 16/6/25
 * Time: 22:58
 * @author 涂鸿 <hayto@foxmail.com>
 */

$client = new swoole_client(SWOOLE_SOCK_UDP, SWOOLE_ASYNC);

$client->connect('127.0.0.1', 9502);

$client->send('asdf');

$data = $client->recv();

echo $data;