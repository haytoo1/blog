<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/5/13 11:13
 */

namespace console\controllers;
use yii;

class SendmailController extends yii\console\Controller
{
    public $subject = '标题哦1';
    /**
     * 控制台命令发邮件,此方法驻留内存55秒,定时任务每分钟执行一次,达到释放内存的效果
     * @return bool
     * @author 涂鸿
     */
    public function actionSendmail()
    {
        $stime = time();
        $redis = yii::$app->redis;
        while ((time()-$stime) < 56){
            // brpop 可以弹出多个list,可以作为实现优先级功能 brop hlist llist 0
            $email = $redis->executeCommand('BRPOP',['emailQueue',0]);
            if(!$email){
                sleep(2);
            }else{
                try{
                    $cache = yii::$app->getCache();
                    $url = $cache->get($email[1]); // 要发送的链接
                    $cache->delete($email[1]);
                    $sender = yii::$app->mailer;
                    $sender->compose('@common/mail/test',['contents'=>['name'=>$email[1],'link'=>$url]])
                        ->setFrom(yii::$app->params['adminEmail'])
                        ->setTo($email[1])
                        ->setSubject($this->subject)
                        ->send();
                    unset($sender);
                }catch (\Exception $e){
                    throw $e;
                }
            }
        }
    }
}