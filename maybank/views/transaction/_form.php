<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Account;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from_account')
        ->textInput(['readonly' => true, 'value' => $model->from_account])?>

    <?= $form->field($model, 'available_balance')
        ->textInput(['readonly' => true, 'value' => $model->available_balance])?>

    <?= $form->field($model, 'to_account')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
