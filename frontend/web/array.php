<?php
/**
 * Created by PhpStorm.
 * Date: 16/7/1
 * Time: 00:16
 * @author 涂鸿 <hayto@foxmail.com>
 */

// 数组学习
$arr = [[[1,2]],[[11,22]]];
foreach($arr as list($a, $b)){
    var_dump($a, $b);
}
// 会输出
// $a=1 $b=2
// $a=11 $b=22