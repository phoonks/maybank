<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Account;

/**
 * AccountholderSearch represents the model behind the search form of `app\models\Accountholder`.
 */
class AccountSearch extends Account
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_id', 'account_number', 'account_type'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Account::find();

        // add conditions that should always apply here
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('user');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'account.is_deleted' => 0,
        ]);

        //for search similer data
        $query->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'account_type', $this->account_type])
            ->andFilterWhere(['like', 'user.user_name', $this->user_id]);
            
         return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
