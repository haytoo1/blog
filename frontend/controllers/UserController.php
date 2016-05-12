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
        $post['data'] = yii::$app->getRequest()->post();

        $model = new User();

        $scenarioArr = [
            'email'=>$model->scenario = 'registerFromEmail',
            'phone'=>$model->scenario = 'registerFromPhone',
        ];
        $scenarioArr[tools::detectionStrIsPhoneOrEmail($post['data']['account'])];

        try{
            if($model->load($post,'data')){
                throw new CustomException('系统错误,请重试');
            }
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

    public function actionActivate()
    {
        $user_sn = yii::$app->getRequest()->get('uid',0);
        if(!empty($user_sn) && User::updateAll(['user_locked'=>1],['user_sn'=>$user_sn])){
            return $this->goHome();
        }
    }
}