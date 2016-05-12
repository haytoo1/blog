<?php
/**
 * Created by PhpStorm.
 * User: too
 * Date: 16/5/11
 * Time: 22:52
 */

namespace frontend\controllers;
use yii;

class IndexController extends yii\web\Controller
{

    public $title = '从PHP到全栈|猛男哦吧';
    public $desc = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public $keyword = 'PHP入门到精通,MySQL中文文档,nginx,redis,JavaScript,HTML5,iOS,yii2框架,不断学习,超越逗比';
    public function actionIndex()
    {
        return $this->render('index');
    }
}