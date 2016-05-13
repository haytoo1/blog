<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/5/13 11:13
 */

namespace console\controllers;
use yii;

class SendmailController extends yii\base\Controller
{
    /**
     * 控制台命令发邮件
     * @return bool
     * @author 涂鸿
     */
    public function actionSendmail()
    {
        $redis = yii::$app->redis;
        $redis->executeCommand('select',[1]);
        while (true){
            $email = $redis->executeCommand('RPOP',['emailQueue']);
            if(!$email){
                sleep(2);
            }else{
                try{
                    yii::$app->mailer
                        ->compose('@common/mail/test',['contents'=>['name'=>'方方','link'=>'https://www.google.com']])
                        ->setFrom(yii::$app->params['adminEmail'])
                        ->setTo($email)
                        ->setSubject('晚上好哟')
                        ->send();
                }catch (\Exception $e){
                    echo $e->getMessage(),PHP_EOL,$email;
                }
            }
        }
    }
}