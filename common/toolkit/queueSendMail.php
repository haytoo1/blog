<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/5/13 10:43
 */

namespace common\toolkit;
use yii;

class queueSendMail
{
    /**
     * 把邮箱加入队列,有后台脚本专门处理队列
     * @param $email
     * @param $url
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>\
     */
    public static function pushMail($email)
    {
        try{
            $redis = yii::$app->redis;
            $redis->executeCommand('lpush',['emailQueue',$email]);
            $url = yii::$app->getUrlManager()->createAbsoluteUrl(['user/activate','token'=>base64_encode($email)],'http');
            yii::$app->getCache()->set($email,$url);
            $res = ['status'=>1,'msg'=>'成功'];
        }catch (\Exception $e){
            $res = ['status'=>0,'msg'=>$e->getMessage()];
        }
        return $res;
    }
}