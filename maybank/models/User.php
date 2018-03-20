<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $identity_card
 * @property string $user_name
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $country_code
 * @property string $phone_no
 * @property string $email
 * @property string $date_of_birth
 * @property string $position
 * @property string $address
 * @property string $country
 * @property string $city
 * @property string $state
 * @property int $postcode
 * @property string $last_logging_time
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
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
            [['date_of_birth', 'last_logging_time', 'created_at', 'updated_at'], 'safe'],
            [['postcode'], 'integer'],
            [['identity_card', 'user_name', 'password', 'first_name', 'last_name', 'name', 'country_code', 'phone_no', 'email', 'position', 'address', 'country', 'city', 'state'], 'string', 'max' => 255],
            [['is_deleted'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identity_card' => 'Identity Card',
            'user_name' => 'User Name',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'name' => 'Name',
            'country_code' => 'Country Code',
            'phone_no' => 'Phone No',
            'email' => 'Email',
            'date_of_birth' => 'Date Of Birth',
            'position' => 'Position',
            'address' => 'Address',
            'country' => 'Country',
            'city' => 'City',
            'state' => 'State',
            'postcode' => 'Postcode',
            'last_logging_time' => 'Last Logging Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($user_name)
    {
        return static::findOne(['user_name' => $user_name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        return $this->password === crypt($password, 'PhoonKahSeng');
    }
}
