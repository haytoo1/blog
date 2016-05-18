<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/5/13 11:13
 */

namespace console\controllers;
use yii;

class SendmailController extends yii\console\Controller
{
    /**
     * 控制台命令发邮件,此方法驻留内存57秒,定时任务每分钟执行一次,达到释放内存的效果
     * @return bool
     * @author 涂鸿
     */
    public function actionSendmail()
    {
        $stime = time();
        $redis = yii::$app->redis;
        while ((time()-$stime) < 57){
            // brpop 可以弹出多个list,可以作为实现优先级功能 brop hlist llist 0
            $data = $redis->executeCommand('BRPOP',['emailQueue',0]); // 这种弹出来的数组，0是key,1才是值
            $key = $data[0];
            if(!$key){
                sleep(2);
            }else{
                try{
                    $val = unserialize($data[1]); // $val 是多维数组
                    if(isset($val['code'])){ // 验证码
                        $this->sendCode($val);
                    }elseif (isset($val['url'])){ // 激活邮件
                        $this->sendUrl($val);
                    }
                }catch (\Exception $e){
                    throw $e;
                }
            }
        }
    }

    private function sendUrl($data)
    {
        yii::$app->mailer->compose('@common/mail/test',['contents'=>['name'=>$data['email'],'link'=>$data['url']]])
            ->setFrom(yii::$app->params['adminEmail'])
            ->setTo($data['email'])
            ->setSubject($data['subject'])
            ->send();
    }
    private function sendCode($data)
    {
        yii::$app->mailer->compose('@common/mail/test',['contents'=>['name'=>$data['email'],'code'=>$data['code']]])
            ->setFrom(yii::$app->params['adminEmail'])
            ->setTo($data['email'])
            ->setSubject($data['subject'])
            ->send();
    }
}