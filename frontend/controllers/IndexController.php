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

    public function actionIndex()
    {
        echo 'index/index';
    }
}