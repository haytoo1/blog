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
use common\toolkit\queueSendMail;
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
            $model->register();
            // 追加进邮件队列
            $url = yii::$app->getUrlManager()->createAbsoluteUrl(['user/activate','id'=>urlencode($post['account'])]);
            queueSendMail::pushMail($post['account'],$url);
            // 记录注册时间,激活用
            $this->recordRegTime($post['account']);

            $userinfo = [
                'name'=>yii::$app->getSession()->get('username')
            ];
            $res = ['msg'=>'注册成功','status'=>1,'userinfo'=>$userinfo];
        }catch(CustomException $e){
            throw $e;
            $res = ['msg'=>$e->getMessage().PHP_EOL,'status'=>0];
        }catch(\Exception $e){
            throw $e;
            $res = ['msg'=>$e->getMessage().PHP_EOL,'status'=>0];
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
        yii::$app->getResponse()->format = 'json';

        $account = yii::$app->getRequest()->get('id',0);
        if(!yii::$app->getCache()->get(urldecode($account))){
            $res = ['status'=>0,'msg'=>'已经过了激活时限,请点击重发邮件'];
        }
        if(!empty($user_sn) && User::updateAll(['user_active'=>1],['user_sn'=>$user_sn])){
            $res = ['status'=>1,'msg'=>'激活成功'];
        }
        return $res;
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
            $userinfo = [
                'name'=>yii::$app->getSession()->get('username')
            ];
            $res = ['status'=>1,'msg'=>'登录成功','userinfo'=>$userinfo];
        }catch (CustomException $e){
            $res = ['status'=>0,'msg'=>$e->getMessage()];
        }catch (\Exception $e){
            $res = ['status'=>0,'msg'=>'系统异常'];
        }
        return $res;
    }

    /**
     * 退出登录
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
    public function actionLogout()
    {
        $a= yii::$app->getCache()->get('466594257@qq.com');
        p($a);
        die;
        yii::$app->getResponse()->format = 'json';
        yii::$app->getSession()->remove('username');
        return ['msg'=>'退出成功','status'=>1,'userinfo'=>''];
    }


    /**
     * 设置邮件激活的时间期限
     * @param $username
     * @author 涂鸿 <hayto@foxmail.com>
     */
    private function recordRegTime($account)
    {
        yii::$app->getCache()->set(urlencode($account),1,yii::$app->params['reg_time']);
    }
}