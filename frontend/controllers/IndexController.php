<?php
/**
 * Created by PhpStorm.
 * User: too
 * Date: 16/5/11
 * Time: 22:52
 */

namespace frontend\controllers;
use common\toolkit\queueSendMail;
use yii;

class IndexController extends yii\web\Controller
{

    public $title = '从PHP到全栈|猛男哦吧';
    public $desc = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public $keyword = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public function actionIndex()
    {
        /*$redis = yii::$app->redis;
        $redis->executeCommand('select',[1]);
        $email = $redis->executeCommand('brpop',['emailQueue',0]);
        p($email);*/
        queueSendMail::pushMail('466594257@qq.com');
        queueSendMail::pushMail('2116398125@qq.com');
        return $this->render('index');
    }
}