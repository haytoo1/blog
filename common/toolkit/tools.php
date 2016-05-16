<?php
/**
 * Created by PhpStorm.
 * User: too
 * Date: 16/5/12
 * Time: 23:09
 */

namespace common\toolkit;
use yii;

class tools
{
    /**
     * 判断字符串是 邮箱 还是 手机号
     * @param $str
     * @return string
     * @author 涂鸿
     */
    public static function detectionStrIsPhoneOrEmail($str){
        if(filter_var($str,FILTER_VALIDATE_EMAIL)){
            return 'email';
        }
        // @todo 还没有开通手机注册,手机检测以后再做
        return 'phone';
    }


    /**
     * 返回带登录状态的数据
     * @param $data
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
    public static function returnDataWithLoginStatus($data)
    {
        $userinfo = [
            'name' => yii::$app->getSession()->get('username')?:''
        ];
        return array_merge(['userinfo' => $userinfo],$data);
    }
}