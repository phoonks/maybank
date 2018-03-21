<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title = 'Transactions History';
?>
<h1>Transactions History</h1>
<div class="transaction-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
            'from_account',
            'to_account',
            'name',
            'amount',
            'last_balance',
            'status',
            'details',
            //'remark',
            'created_at',
            //'updated_at',
            //'is_deleted',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
