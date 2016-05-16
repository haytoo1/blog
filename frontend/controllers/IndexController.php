<?php
namespace frontend\controllers;
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
            $userinfo = yii::$app->getSession()->get('username');
            return ['status'=>1,'msg'=>'ok','userinfo'=>$userinfo,'data'=>[]];
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
        return $this->render('article');
    }
}