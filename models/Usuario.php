<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $id
 * @property string $authKey
 * @property string $accessToken
 * @property integer $activate
 * @property integer $role
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'authKey', 'accessToken', 'activate', 'role'], 'required'],
            [['username'], 'string', 'max' => 50],
            [['activate'], 'string', 'max' => 10],
            [['role'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 80],
            [['authKey', 'accessToken', 'password'], 'string', 'max' =>250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de Usuario',
            'email' => 'Email',
            'password' => 'Contraseña',
            'id' => 'ID',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'activate' => 'Activo',
            'role' => 'Nivel de acceso',
        ];
    }
}
