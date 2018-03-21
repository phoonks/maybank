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
    public $id;
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
    public $status;
    public $date;

    public function rules()
    {
        return [
            [['identity_card', 'account_number'], 'required'],
            [['account_number'], 'unique', 'targetClass' => '\app\models\Account', 'targetAttribute' => 'account_number'],
            [['user_name'], 'unique', 'targetClass' => '\app\models\User', 'targetAttribute' => 'user_name'],
            [['identity_card'], 'unique', 'targetClass' => '\app\models\User', 'targetAttribute' => 'identity_card'],
            ['email', 'email'],
            ['current_balance', 'number', 'min' => 0],
            [['user_id', 'available_balance', 'current_balance'], 'integer'],
            [['first_name', 'last_name', 'name', 'country_code', 'phone_no', 'date_of_birth', 'position', 'address', 'country', 'city', 'state', 'postcode', 'email', 'account_type', 'status', 'password'], 'safe'],
        ];
    }

    public function register()
    {
        $user = new User;
        $this->date = date('Y-m-d');
        // if($this->date_of_birth !== 'Y-m-d') {
        //     throw new \Exception('Please enter correct date!');
        // }
        // if($this->date_of_birth < date('Y-m-d H:i:s')) {
        //     throw new \Exception('Date cannot more than today!');
        // }
        $user->identity_card = $this->identity_card;
        $user->user_name = $this->user_name;
        $user->password = crypt($this->password, 'PhoonKahSeng');
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->name = $this->name;
        $user->country_code = "+60";//$this->country_code;
        $user->phone_no = $this->phone_no;
        $user->date_of_birth = $this->date_of_birth;
        $user->position = 'User';
        $user->address = $this->address;
        $user->country = $this->country;
        $user->city = $this->city;
        $user->state = $this->state;
        $user->postcode = $this->postcode;
        $user->email = $this->email;
        $user->status = 'Inactivate';
        $user->last_logging_time = date('Y-m-d H:i:s');
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->is_deleted = 0;
        if(!$user->save()) {
            throw new \Exception(current($user->getFirstErrors()));
        }
        return true;
    }

    public function create_account() {
        $account = new Account;

        $account->user_id = $this->user_name;
        $account->account_number = $this->account_number;
        $account->current_balance = $this->current_balance;
        $account->account_type = $this->account_type;
        $account->available_balance = ($this->current_balance)-20;
        $account->created_at = date('Y-m-d H:i:s');
        $account->updated_at = date('Y-m-d H:i:s');
        $account->is_deleted = 0;

        $this->update_status($this->user_name);
        if(!$account->save()) {
            throw new \Exception(current($account->getFirstErrors()));
        }
    }

    public function add_account() {
        $account = new Account;

        $account->user_id = $this->user_id;
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
    }

    public function update_status($id) {
        $user = User::findOne($id);
        $user->status = 'Activate';
        
        if(!$user->update(false, ['status'])) {
            throw new \Exception(current($user->getFirstErrors()));  
        }
    }
    
    public function update_position() {
        $user = User::findOne($this->user_name);
        $user->position = $this->position;
        
        if(!$user->update(false, ['position'])) {
            throw new \Exception(current($user->getFirstErrors()));  
        }
    }

    public function account_number() {
        $account = Account::find()
            ->where(['id' => Account::find()->max('id')])
            ->one();
        $this->account_number = $account->account_number + 1;
    }

}
