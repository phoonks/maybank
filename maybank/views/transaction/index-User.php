<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Generate PDF', ['gen-pdf'], ['class' => 'btn btn-success']) ?>
    </p>

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
