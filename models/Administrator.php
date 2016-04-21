<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Administrator extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%administrators}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'name' => '姓名',
            'password' => '密码',
            'email' => '邮箱',
            'phone' => '电话'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','name'],'required'],
            ['password','required','on'=>'insert'],
            ['password','filterPassword','skipOnEmpty'=>false],
            ['username','unique'],
            ['username','match', 'pattern' => '/^[0-9a-z_]+$/i','message'=>'{attribute}只允许使用数字,字母,下划线组合'],
            ['email','email'],
            ['phone','match','pattern'=>'/^[0-9\-\+]+$/','message'=>'{attribute}不合法']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {

    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {

    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }

    /**
     * 更新密码
     *
     * @param $newpassword
     * @return bool
     * @throws \yii\base\Exception
     */
    public function renewPassword($newpassword)
    {
        $this->password = $newpassword;
        return $this->save();
    }

    public function filterPassword($attribute,$params)
    {
        //密码不为空的时候才更新密码,否则不作任何改动
        if ($this->$attribute != "") {
            $this->$attribute = Yii::$app->getSecurity()->generatePasswordHash($this->$attribute);
        } else {
            $this->$attribute = $this->getOldAttribute('password');
        }
    }

    /**
     * 保存前的事件
     *
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        //创建时间
        if ($insert) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
}
