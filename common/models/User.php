<?php

namespace common\models;

use Yii;

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
 */
class User extends \yii\db\ActiveRecord
{
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
            [['user_passwd'], 'string', 'max' => 12],
            [['user_salt'], 'string', 'max' => 10],
            [['user_province', 'user_city', 'user_county'], 'string', 'max' => 5],
            [['user_ip'], 'string', 'max' => 15],
            [['user_phone'], 'unique'],
            [['user_email'], 'unique'],
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
            'registerFromEmail' => ['user_email','user_passwd'],
            'registerFromPhone' => ['user_phone','user_passwd']
        ];
    }

    /**
     * 生成随机昵称
     * @return string
     */
    private function generateNickname(){
        return '编号'.mt_rand(000000,999999);
    }

    public function registerFromEmail()
    {

    }
}
