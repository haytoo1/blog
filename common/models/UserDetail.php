<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_detail".
 *
 * @property integer $ud_user_id
 * @property string $ud_photo
 * @property string $ud_motto
 * @property string $ud_intro
 */
class UserDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ud_user_id'], 'required'],
            [['ud_user_id'], 'integer'],
            [['ud_photo'], 'string', 'max' => 200],
            [['ud_motto'], 'string', 'max' => 50],
            [['ud_intro'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ud_user_id' => '关联user表user_id',
            'ud_photo' => '用户头像',
            'ud_motto' => '个性签名',
            'ud_intro' => '用户介绍信息',
        ];
    }
}
