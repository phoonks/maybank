<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'identity_card',
            'user_name',
            //'password',
            //'first_name',
            'status',
            //'last_name',
            'name',
            //'country_code',
            //'phone_no',
            'email:email',
            //'date_of_birth',
            'position',
            //'address',
            //'country',
            //'city',
            //'state',
            //'postcode',
            //'last_logging_time',
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
                            Url::to('maybank/maybank/web/account/viewaccount?id='.$model->id, true)
                            );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
