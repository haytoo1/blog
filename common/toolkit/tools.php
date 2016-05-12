<?php
/**
 * Created by PhpStorm.
 * User: too
 * Date: 16/5/12
 * Time: 23:09
 */

namespace common\toolkit;


class tools
{
    public static function detectionStrIsPhoneOrEmail($str){
        if(filter_var($str,FILTER_VALIDATE_EMAIL)){
            return 'email';
        }
        // @todo 还没有开通手机注册,手机检测以后再做
        return 'phone';
    }
}