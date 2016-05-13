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
                        ->compose('@common/mail/test',['contents'=>['name'=>'lsit','link'=>'http://www.google.com']])
                        ->setFrom(yii::$app->params['adminEmail'])
                        ->setTo($email)
                        ->setSubject('搞快激活')
//            ->setHtmlBody('<img src="data:image/jpeg;base64,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">')
                        ->send();
                }catch (\Exception $e){
                    echo $e->getMessage(),PHP_EOL,$email;
                }
            }
        }
    }
}