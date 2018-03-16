<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * ContactForm is the model behind the contact form.
 */
class FindnameForm extends Model
{
    public $user_name;
    
    public function rules()
    {
        return [
            [['user_name'], 'required'],
        ];
    }

    public function findname()
    {
        $user = User::find()
            ->where(['user_name' => $this->user_name])
            ->one();
        if ($user === null) {
            throw new \Exception('User Not Exits');
        }
        return $user;
    }
}
