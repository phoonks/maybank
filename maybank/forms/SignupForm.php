<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;

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

    public function rules()
    {
        return [
            [['identity_card', 'user_name', 'password'], 'required'],
            [['first_name', 'last_name', 'name', 'country_code', 'phone_no', 'date_of_birth', 'position', 'address', 'country', 'city', 'state', 'postcode', 'email'], 'safe'],
        ];
    }

    public function register()
    {
        $model = new User;
        $model->identity_card = $this->identity_card;
        $model->user_name = $this->user_name;
        $model->password = $this->password;
        $model->first_name = $this->first_name;
        $model->last_name = $this->last_name;
        $model->name = $this->name;
        $model->country_code = "+60";//$this->country_code;
        $model->phone_no = $this->phone_no;
        $model->date_of_birth = $this->date_of_birth;
        $model->position = $this->position;
        $model->address = $this->address;
        $model->country = $this->country;
        $model->city = $this->city;
        $model->state = $this->state;
        $model->postcode = $this->postcode;
        $model->email = $this->email;
        $model->last_logging_time = date('Y-m-d H:i:s');
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        $model->is_deleted = 0;
        if(!$model->save()) {
            throw new \Exception(current($model->getFirstErrors()));
        }     
        return $model;
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
