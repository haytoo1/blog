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
    public $layout = 'main.html';
    public function actionIndex()
    {
        return $this->render('index.html');
    }
}