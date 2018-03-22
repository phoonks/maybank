<?php

namespace app\forms;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
use app\models\Transaction;
use app\models\Account;

/**
 * ContactForm is the model behind the contact form.
 */
class TransactionForm extends Model
{
    public $user_id;
    public $from_account;
    public $to_account;
    public $name;
    public $amount;
    public $last_balance;
    public $status;
    public $details;
    public $remark;
    public $available_balance;
    public $to_user_id;
    public $to_available_balance;

    public function rules()
    {
        return [
            [['from_account', 'to_account'], 'required'],
            [['user_id'], 'integer'],
            [['amount', 'last_balance'], 'double'],
            [['name', 'status', 'details', 'remark', 'available_balance'], 'safe'],
            ['to_account', 'compare', 'compareAttribute' => 'from_account', 'operator' => '!='],
            ['amount', 'number', 'min' => 1],
            ['amount', 'number', 'max' => $this->available_balance],
            // ['amount', 'compare', 'compareAttribute' => 'available_balance', 'operator' => '<'],
        ];
    }


    public function transaction()
    {
        $out = new Transaction;
        $in = new Transaction;

        //out account
        $out->user_id = Yii::$app->user->identity->id;
        $out->from_account = $this->from_account;
        $out->to_account = $this->to_account;
        $out->name = $this->name;
        $out->amount = $this->amount;
        $out->last_balance = $this->available_balance - $this->amount;
        $out->status = 'OUT';
        $out->details = $this->details;
        $out->remark = $this->remark;
        $out->created_at = date('Y-m-d H:i:s');
        $out->updated_at = date('Y-m-d H:i:s');
        $out->is_deleted = 0;
        if(!$out->save()) {
            throw new \Exception(current($out->getFirstErrors()));
        }
        $this->getUpdateavailablebalance($out->from_account, $out->last_balance);

        //in account
        $in->user_id = $this->getToaccountid($out->to_account);
        $to_available_balance = $this->getTobalance($in->user_id);

        $in->from_account = $this->from_account;
        $in->to_account = $this->to_account;
        $in->name = $this->name;
        $in->amount = $this->amount;
        $in->last_balance = $to_available_balance + $this->amount;
        $in->status = 'IN';
        $in->details = $this->details;
        $in->remark = $this->remark;
        $in->created_at = date('Y-m-d H:i:s');
        $in->updated_at = date('Y-m-d H:i:s');
        $in->is_deleted = 0;
        if(!$in->save()) {
            throw new \Exception(current($in->getFirstErrors()));
        }
        $this->getUpdateavailablebalance($in->to_account, $in->last_balance);

        return true;
    }
    
    public function getAccount($account_number)
    {
        $this->from_account = $account_number;
    }

    public function getBalance($account_number)
    {
        $account = Account::find()
            ->select('available_balance')
            ->where(['account_number' => $account_number])
            ->one();
        $this->available_balance = $account->available_balance;
    }

    public function getToaccountid($to_account)
    {
        $account = Account::find()
            ->select('user_id')
            ->where(['account_number' => $to_account])
            ->one();
        return $account->user_id;
    }

    public function getTobalance($in_id)
    {
        $account = Account::find()
            ->select('available_balance')
            ->where(['user_id' => $in_id])
            ->one();
        return (int)$account->available_balance;
    }

    public function getUpdateavailablebalance($account_number, $last_balance)
    {
        $account = Account::find()
            ->where(['account_number' => $account_number])
            ->one();
        $account->available_balance = $last_balance;
        $account->current_balance = $last_balance + 20;
        try {
            if(!$account->update(false, ['available_balance', 'current_balance'])) {
                throw new \Exception(current($model->getFirstErrors()));
            }
        }catch(\Exception $e) {
            echo $e->getMessage();
        }    
    }
}
