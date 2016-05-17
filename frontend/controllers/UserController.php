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
            $url = yii::$app->getUrlManager()->createAbsoluteUrl(['user/activate','token'=>base64_encode($post['account'])],'http');
            queueSendMail::pushMail(['email'=>$post['account'],'url'=>$url,'subject'=>'激活']);
            // 记录注册时间,激活用
            $this->recordRegTime($post['account']);
            $res = ['msg'=>'注册成功','status'=>1];
        }catch(CustomException $e){
            $res = ['msg'=>$e->getMessage().PHP_EOL,'status'=>0];
        }catch(\Exception $e){
            $res = ['msg'=>$e->getMessage().PHP_EOL,'status'=>0];
        }
        return tools::returnDataWithLoginStatus($res);
    }

    /**
     * 通过邮箱注册的，需要调用这个方法激活
     * @return yii\web\Response
     * @author 涂鸿
     */
    public function actionActivate()
    {
        yii::$app->getResponse()->format = 'json';
        $account = yii::$app->getRequest()->get('token',0);
        try{
            if(!yii::$app->getCache()->get($account)){
                throw new CustomException('已经过了激活时限,请点击重发邮件');
            }
            if(!empty($account) !== true){
                throw new CustomException('错误的请求');
            }
            if(!User::updateAll(['user_active'=>0],['user_email'=>base64_decode($account)])){
                throw new CustomException('激活失败');
            }
            $session = yii::$app->getSession();
            $session['userinfo'] = [
                'user_nickname'=>$session['userinfo']['user_nickname'],
                'user_locked'=>$session['userinfo']['user_locked'],
                'user_active'=>0,
            ];
            $res = ['status'=>1,'msg'=>'激活成功'];
        }catch(CustomException $e){
            $res = ['status'=>0,'msg'=>$e->getMessage()];
        }
        return $res;
    }

    /**
     * 用户登录
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
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
            $res = ['status'=>0,'msg'=>'系统异常'];
        }
        return tools::returnDataWithLoginStatus($res);
    }

    /**
     * 退出登录
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
    public function actionLogout()
    {
        yii::$app->getResponse()->format = 'json';
        yii::$app->getSession()->remove('userinfo');
        return tools::returnDataWithLoginStatus(['msg'=>'退出成功','status'=>1]);
    }

    /**
     * 重新发送激活邮件
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
    public function actionResendemail()
    {
        yii::$app->getResponse()->format = 'json';
        $account = yii::$app->getRequest()->get('token','');
        $account = urldecode($account);
//        $account = base64_decode($account);
        try{
            if(!empty($account) !== true){
                throw new CustomException('错误的请求');
            }
            // 追加进邮件队列
            $url = yii::$app->getUrlManager()->createAbsoluteUrl(['user/activate','token'=>base64_encode($account)],'http');
            queueSendMail::pushMail(['email'=>$account,'url'=>$url,'subject'=>'重新激活']);
            // 记录注册时间,激活用
            $this->recordRegTime($account);
            $res = ['status'=>1,'msg'=>'发送成功'];
        }catch(CustomException $e){
            $res = ['status'=>0,'msg'=>'系统错误'];
        }
        return tools::returnDataWithLoginStatus($res);
    }

    /**
     * 发送验证码
     * @return array
     * @author 涂鸿
     */
    public function actionSendcode()
    {
        yii::$app->getResponse()->format = 'json';
        $model = new User();
        $account = yii::$app->getRequest()->get('account');
        $model->account = $account;
        return $model->sendFindPwdEmail();
    }

    /**
     * 通过验证码找回密码
     * @author 涂鸿
     */
    public function actionFindpwd()
    {
        yii::$app->getResponse()->format = 'json';
        $post = yii::$app->getRequest()->get();
        $model = new User();
        $model->account = $post['account'];
        $model->verifycode = $post['verifycode'];
        $model->user_passwd = $post['user_passwd'];
        $model->repasswd = $post['repasswd'];
        $model->findPwd();
        
    }


    /**
     * 设置邮件激活的时间期限
     * @param $username
     * @author 涂鸿 <hayto@foxmail.com>
     */
    private function recordRegTime($account)
    {
        yii::$app->getCache()->set(base64_encode($account),1,yii::$app->params['reg_time']);
    }
}