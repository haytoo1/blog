<?php

namespace common\models;

use common\toolkit\CustomException;
use common\toolkit\tools;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $user_sn
 * @property string $user_nickname
 * @property string $user_email
 * @property string $user_phone
 * @property string $user_passwd
 * @property string $user_salt
 * @property integer $user_gender
 * @property string $user_regdate
 * @property string $user_lastlogindate
 * @property integer $user_locked
 * @property integer $user_deleted
 * @property string $user_province
 * @property string $user_city
 * @property string $user_county
 * @property string $user_ip
 * @property string $account
 *
 */
class User extends \yii\db\ActiveRecord
{
    public $account;
    public $repasswd;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_sn', 'user_nickname', 'user_email', 'user_phone', 'user_passwd', 'user_salt', 'user_province', 'user_city', 'user_county', 'user_ip'], 'required'],
            [['user_gender', 'user_locked', 'user_deleted'], 'integer'],
            [['user_regdate', 'user_lastlogindate'], 'safe'],
            [['user_sn'], 'string', 'max' => 16],
            [['user_nickname'], 'string', 'max' => 8],
            [['user_email'], 'string', 'max' => 20],
            [['user_phone'], 'string', 'max' => 11],
            [['user_passwd'], 'string', 'min'=>6,'max' => 12,'tooShort'=>'密码最少有6位','tooLong'=>'密码最长12位'],
            [['user_salt'], 'string', 'max' => 10],
            [['user_province', 'user_city', 'user_county'], 'string', 'max' => 5],
            [['user_ip'], 'string', 'max' => 15],
            [['user_phone'], 'safe'],
            [['user_email'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_sn' => '16位用户号',
            'user_nickname' => '最长8字符昵称',
            'user_email' => '主邮箱，可用作登录',
            'user_phone' => '手机号码，可用于登录',
            'user_passwd' => '最长12位的密码',
            'user_salt' => '10位加密串',
            'user_gender' => '0女 1男 2保密',
            'user_regdate' => '注册时间',
            'user_lastlogindate' => '最后一次登录时间',
            'user_locked' => '0正常 1锁定',
            'user_deleted' => '0正常 1删除',
            'user_province' => '省',
            'user_city' => '市',
            'user_county' => '县',
            'user_ip' => '用户ip',
        ];
    }

    public function scenarios()
    {
        return [
            'register' => ['account','user_passwd','repasswd'],
//            'registerFromPhone' => ['user_phone','user_passwd'],
            'login' => ['account','user_passwd'],
        ];
    }

    /**
     * 生成随机昵称
     * @return string
     */
    private function generateNickname(){
        return '编号'.mt_rand(000000,999999);
    }

    public function register()
    {
        if($this->user_passwd !== $this->repasswd){
            throw new CustomException('两次密码不一致');
        }
        // 判断注册用户是否已存在
        if($this->existAccount()){
            throw new CustomException('该账号已经存在');
        }
        if(empty($this->user_email) && empty($this->user_phone)){
            throw new CustomException('请输入邮箱或账号');
        }

        $this->user_salt = yii::$app->security->generateRandomString(10);
        $this->user_passwd = $this->encryptPwd();
        $this->user_sn = 'SN' . yii::$app->security->generateRandomString(14);
        $this->user_nickname = $this->generateNickname();

        return $this->insert(false);
    }

    /**
     * 用户登录
     * @return bool
     * @throws CustomException
     * @author 涂鸿
     */
    public function login()
    {
        $_info = (new Query())->select(['user_passwd','user_salt','user_nickname'])->from(self::tableName())
            ->where(['user_email'=>$this->account])
            ->one();
        if(!empty($_info) === false){
            throw new CustomException('账号不存在');
        }
        if($_info['user_passwd'] !== md5($_info['user_salt'] . $this->user_passwd)){
            throw new CustomException('密码错误');
        }

        yii::$app->getSession()->set('username',$_info['user_nickname']);
        return true;
    }

    /**
     * 加密密码
     * @return mixed
     * @author 涂鸿
     */
    private function encryptPwd()
    {
        return md5($this->user_salt . $this->user_passwd);
    }

    /**
     * 判断当前注册的账号是否已经存在
     * @return bool true已经存在 false可以注册
     * @author 涂鸿
     */
    private function existAccount()
    {
        $_temp = tools::detectionStrIsPhoneOrEmail($this->account);
        $res = false;
        switch ($_temp){
            case 'email':
                $this->user_email = $this->account;
                $res = self::find()->where(['user_email'=>$this->account])->exists();
                break;
            case 'phone':
                $this->user_phone = $this->account;
                $res = self::find()->where(['user_email'=>$this->account])->exists();
                break;
        }
        return $res;
    }
}
