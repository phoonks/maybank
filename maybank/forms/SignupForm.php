<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Account;

/**
 * ContactForm is the model behind the contact form.
 */
class SignupForm extends Model
{
    public $identity_card;
    public $user_name;
    public $password;
    public $first_name;
    public $last_name;
    public $name;
    public $country_code;
    public $phone_no;
    public $date_of_birth;
    public $position;
    public $address;
    public $country;
    public $city;
    public $state;
    public $postcode;
    public $email;
    public $user_id;
    public $account_number;
    public $available_balance;
    public $current_balance;
    public $account_type;

    public function rules()
    {
        return [
            [['identity_card', 'user_name', 'password'], 'required'],
            [['user_id', 'available_balance', 'current_balance'], 'integer'],
            [['first_name', 'last_name', 'name', 'country_code', 'phone_no', 'date_of_birth', 'position', 'address', 'country', 'city', 'state', 'postcode', 'email', 'account_number', 'account_type'], 'safe'],
        ];
    }

    public function register()
    {
        $user = new User;
        $account = new Account;

        $user->identity_card = $this->identity_card;
        $user->user_name = $this->user_name;
        $user->password = crypt($this->password, 'PhoonKahSeng');
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->name = $this->name;
        $user->country_code = "+60";//$this->country_code;
        $user->phone_no = $this->phone_no;
        $user->date_of_birth = $this->date_of_birth;
        $user->position = $this->position;
        $user->address = $this->address;
        $user->country = $this->country;
        $user->city = $this->city;
        $user->state = $this->state;
        $user->postcode = $this->postcode;
        $user->email = $this->email;
        $user->last_logging_time = date('Y-m-d H:i:s');
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->is_deleted = 0;
        if(!$user->save()) {
            throw new \Exception(current($user->getFirstErrors()));
        }

        $account->user_id = $user->id;
        $account->account_number = $this->account_number;
        $account->current_balance = $this->current_balance;
        $account->account_type = $this->account_type;
        $account->available_balance = ($this->current_balance)-20;
        $account->created_at = date('Y-m-d H:i:s');
        $account->updated_at = date('Y-m-d H:i:s');
        $account->is_deleted = 0;

        if(!$account->save()) {
            throw new \Exception(current($account->getFirstErrors()));
        }
        return true;

    }

    // public function update($id)
    // {
    //     $db = Yii::$app->db->beginTransaction();
    //     $model = Accountholder::findOne($id);
    //     try {
    //             $model->identity_card = $this->identity_card;
    //             $model->first_name = $this->first_name;
    //             $model->last_name = $this->last_name;
    //             $model->name = $this->name;
    //             $model->country_code = $this->country_code;
    //             $model->phone_no = $this->phone_no;
    //             $model->date_of_birth = $this->date_of_birth;
    //             $model->position = $this->position;
    //             $model->address = $this->address;
    //             $model->country = $this->country;
    //             $model->city = $this->city;
    //             $model->state = $this->state;
    //             $model->postcode = $this->postcode;
    //             $model->email = $this->email;
    //             $model->updated_at = $this->date('Y-m-d H:i:s');
    //             $db->commit();
    //         if(!$model->save()) {
    //             throw new \Exception(current($model->getFirstErrors()));
    //         }
    //     }catch(\Exception $e) {
    //             $db->rollback();
    //             return $e->getMessage();
    //     }
    //     return $model;
    // }
}
