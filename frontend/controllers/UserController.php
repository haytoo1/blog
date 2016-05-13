<?php
/**
 * Created by PhpStorm.
 * User: too
 * Date: 16/5/12
 * Time: 22:35
 */

namespace frontend\controllers;
use common\models\User;
use common\toolkit\CustomException;
use common\toolkit\tools;
use yii;

class UserController extends yii\web\Controller
{
    /**
     * 邮箱注册
     * @return array
     */
    public function actionRegister()
    {
        yii::$app->getResponse()->format = 'json';
        $post = yii::$app->getRequest()->post();
        $model = new User();
        $model->setScenario('register');
        try{
            $model->account = $post['account'];
            $model->user_passwd = $post['user_passwd'];
            $model->repasswd = $post['repasswd'];
            if(!$model->validate()){
                $errors = $model->getFirstErrors();
                throw new CustomException(reset($errors));
            }
            $model->registerFromEmail();
            
            $res = ['msg'=>'注册成功','status'=>1];
        }catch(CustomException $e){
            $res = ['msg'=>$e->getMessage(),'status'=>0];
        }catch(\Exception $e){
            $res = ['msg'=>$e->getMessage(),'status'=>0];
        }
        return $res;
    }

    /**
     * 通过邮箱注册的，需要调用这个方法激活
     * @return yii\web\Response
     * @author 涂鸿
     */
    public function actionActivate()
    {
        $user_sn = yii::$app->getRequest()->get('uid',0);
        if(!empty($user_sn) && User::updateAll(['user_locked'=>1],['user_sn'=>$user_sn])){
            return $this->goHome();
        }
    }

    public function actionLogin()
    {
        yii::$app->getResponse()->format = 'json';
        $post = yii::$app->getRequest()->post();
        $model = new User();
        $model->scenario = 'login';
        try{
            $model->account = $post['account'];
            $model->user_passwd = $post['user_passwd'];
            if(!$model->validate()){
                $errors = $model->getFirstErrors();
                throw new CustomException(reset($errors));
            }
            $model->login();
            $res = ['status'=>1,'msg'=>'登录成功'];
        }catch (CustomException $e){
            $res = ['status'=>0,'msg'=>$e->getMessage()];
        }catch (\Exception $e){
            $res = ['status'=>0,'msg'=>'系统异常1'];
        }
        yii\helpers\Url::to(['user/login','account'=>'邮箱','user_passwd'=>'密码'])
        return $res;
    }
}