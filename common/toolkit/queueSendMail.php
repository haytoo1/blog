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
     * 把待发邮件加入队列,有后台脚本专门处理队列
     * @param $data 参数类似于['email'=>$post['account'],'url'=>$url,'code'=>1024,'subject'=>'激活']
     * @param $data email subject 必须要有 url code必须有其中一个
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>\
     */
    public static function pushMail($data)
    {
        try{
            $redis = yii::$app->redis;
            $redis->executeCommand('lpush',['emailQueue',serialize($data)]);
            $res = ['status'=>1,'msg'=>'成功'];
        }catch (\Exception $e){
            $res = ['status'=>0,'msg'=>$e->getMessage()];
        }
        return $res;
    }
}