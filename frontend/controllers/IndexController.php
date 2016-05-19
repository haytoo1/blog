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


        $ip = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_CDN_SRC_IP']) && $_SERVER['HTTP_CDN_SRC_IP']) {
            $ip = $_SERVER['HTTP_CDN_SRC_IP'];
        } else {
            if(!isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                return '';
            }
            $ip_temp = $_SERVER['HTTP_X_FORWARDED_FOR'];
            trim($ip_temp);
            if (strpos($ip_temp, ',')) {
                $ip_arr_tmp = explode(',', $ip_temp);
                foreach ($ip_arr_tmp as $_v) {
//                    if (in_array(trim($_v), $cdnlist) === false) {
                        $ip .= trim($_v);
//                    }
                }
            } else {
//                if (in_array($ip_temp, $cdnlist) === false) {
                    $ip = trim($ip_temp);
//                }
            }
        }
        file_put_contents('ip.txt',$ip,PHP_EOL);
//        echo trim($ip);
        return;

        if(yii::$app->getRequest()->getIsAjax()){
            yii::$app->getResponse()->format = 'json';
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

        /*$redis = yii::$app->getSession();
        foreach ($redis as $k=>$v){
            $a[$k] = ($k=== 'user_active') ? 0 :$v;
        }
        $redis['userinfo'] = [
            'user_active'=>$redis['userinfo']['user_active']
        ];
        p($redis,$a);*/
        return $this->render('article');
    }
}