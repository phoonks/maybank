<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>

    <?php else: ?>

    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'identity_card',
            'user_name',
            'password',
            'first_name',
            'last_name',
            'name',
            'country_code',
            'phone_no',
            'email:email',
            'date_of_birth',
            'position',
            'address',
            'country',
            'city',
            'state',
            'postcode',
            'last_logging_time',
            'created_at',
            'updated_at',
            'is_deleted',
        ],
    ]) ?>

</div>
