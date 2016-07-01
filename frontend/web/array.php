<?php
/**
 * Created by PhpStorm.
 * Date: 16/7/1
 * Time: 00:16
 * @author 涂鸿 <hayto@foxmail.com>
 */

$t1 = '2015-11-10 12:20:31';
$t2 = '2015-11-10 18:20:38';
$base = '1970-01-01 00:00:00';
echo strtotime($base);die;
$s = strtotime($t2)-strtotime($t1);
//echo $s;
echo gmdate('d天H时i分s秒', $s);


