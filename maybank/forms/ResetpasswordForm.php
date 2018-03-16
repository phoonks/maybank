<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * ContactForm is the model behind the contact form.
 */
class ResetpasswordForm extends Model
{
    public $password;
    public $confirm;
    public $securitycode;

    public function rules()
    {
        return [
            [['password', 'confirm', 'securitycode'], 'required'],
            ['confirm', 'compare', 'compareAttribute' => 'password', 'operator' => '<='],
        ];
    }

    public function reset($id)
    {
        try {
            $code = Yii::app()->cache->get('code');
            if ($data === false) {
                throw new \Exception('Data is expired');
            }
            $user = User::findOne($id);
        
            if ($code != (int)$this->securitycode) {
                return false;
            }
            $user->password = crypt($this->password, 'PhoonKahSeng');
            if(!$user->update(false, ['password'])) {
                throw new \Exception(current($user->getFirstErrors()));
            }
        }catch(\Exception $e) {
            echo $e->getMessage();
        }
        return true;

    }
}
