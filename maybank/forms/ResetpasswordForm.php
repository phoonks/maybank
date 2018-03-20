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
            [['password', 'confirm'], 'required'],
            [['securitycode'], 'integer'],
            ['confirm', 'compare', 'compareAttribute' => 'password', 'operator' => '<='],
        ];
    }

    public function reset($id)
    {
        // $code = Yii::$app->cache->get('code');
        // if ($code != $this->securitycode) {
        //     throw new \Exception($code);
        // }
        $user = User::findOne($id);
        $user->password = crypt($this->password, 'PhoonKahSeng');
        if(!$user->update(false, ['password'])) {
            throw new \Exception(current($user->getFirstErrors()));
        }
        return true;

    }
}
