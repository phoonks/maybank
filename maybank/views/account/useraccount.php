<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'account_number',
            'available_balance',
            'current_balance',
            'account_type',
            //'created_at',
            //'updated_at',
            //'is_deleted',
            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            Url::to('maybank/maybank/web/account/view?id=' . $model->id, true)
                            );
                    }
                ],

            ],
        ],
    ]); ?>
</div>
