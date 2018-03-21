<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')
        ->textInput() ?>

    <?= $form->field($model, 'account_number')->textInput(['value' => $model->account_number,
                    'readonly' => true]) ?>
                    
    <?= $form->field($model, 'account_type')->dropDownList([
                    'Fixed Account' => 'Fixed Account', 
                    'Saving Account' => 'Saving Account']) 
                    ->hint("Select Your Account Type") ?>

    <?= $form->field($model, 'current_balance')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
