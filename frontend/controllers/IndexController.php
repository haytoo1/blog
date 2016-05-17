<?php
namespace frontend\controllers;
use common\toolkit\tools;
use yii;

/**
 * Class IndexController
 * @package frontend\controllers
 * @author 涂鸿 <hayto@foxmail.com>
 */

class IndexController extends yii\web\Controller
{

    public $title = '从PHP到全栈|猛男哦吧';
    public $desc = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public $keyword = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public function actionIndex()
    {
        if(yii::$app->getRequest()->getIsAjax()){
            yii::$app->getResponse()->format = 'json';
            $userinfo = [
                'name' => yii::$app->getSession()->get('username')
            ];
            return tools::returnDataWithLoginStatus(['status'=>1,'msg'=>'ok','data'=>[]]);
        }
        return $this->render('index');
    }

    /**
     * 文章详情
     * @return string
     * @author 涂鸿
     */
    public function actionArticle()
    {
        $redis = yii::$app->redis;
        $redis->executeCommand('lpush',['emailQueue',serialize(['email'=>11,'url'=>22,'subject'=>33])]);
        return $this->render('article');
    }
}