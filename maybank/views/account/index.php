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

    <p>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => 'user.user_name',
            ],
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
                            Url::to('maybank/maybank/web/transaction/index?id='.$model->user_id, true)
                            );
                    }
                ],],
        ],
    ]); ?>
</div>
