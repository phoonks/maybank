<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $user_id
 * @property int $from_account
 * @property int $to_account
 * @property string $name
 * @property double $amount
 * @property double $last_balance
 * @property string $status
 * @property string $details
 * @property string $remark
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_deleted
 *
 * @property Account $fromAccount
 * @property Account $toAccount
 * @property User $user
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'from_account', 'to_account'], 'required'],
            [['amount', 'last_balance'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'status', 'details', 'remark'], 'string', 'max' => 255],
            [['is_deleted'], 'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'from_account' => 'From Account',
            'to_account' => 'To Account',
            'name' => 'Name',
            'amount' => 'Amount',
            'last_balance' => 'Last Balance',
            'status' => 'Status',
            'details' => 'Details',
            'remark' => 'Remark',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
