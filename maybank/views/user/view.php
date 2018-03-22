<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Generate PDF', ['gen-pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

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
            //'created_at',
            //'updated_at',
            //'is_deleted',
        ],
    ]) ?>

</div>
