<?php
/**
 * Created by PhpStorm.
 * Date: 16/5/18
 * Time: 20:03
 * @author 涂鸿 <hayto@foxmail.com>
 */

namespace frontend\controllers;
use Faker\Provider\DateTime;
use yii;

class DevtestController extends yii\web\Controller
{
    public $title = '前端开发页面';
    public $desc = '前端开发页面';
    public $keyword = '前端开发页面';
    public function actionIndex()
    {
        return $this->renderPartial('index.html');
    }
    public function actionArticle()
    {
        return $this->renderPartial('article.html');
    }
    public function actionMarkdown()
    {
        return $this->renderPartial('markdown.html');
    }
    public function actionSem()
    {
        return $this->renderPartial('sem.html');
    }


    public function actionT()
    {
        /*$tash = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_ASYNC);
        if(!$client = $tash->connect('127.0.0.1', 9501)){
            echo 'Connect Fail';
        }
        $tash->send(json_encode([1,2,3]));
        echo posix_getpid();*/



//        ini_set('memory_limit', '64M');
        p(ini_get('memory_limit'));
    }
}