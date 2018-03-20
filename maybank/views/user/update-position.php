<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->dropDownList($listData)->label('User Name')->hint("Select User Name") ?>

    <?= $form->field($model, 'position')->dropDownList([
                    'Admin' => 'Admin', 
                    'User' => 'User']) 
                    ->hint("Select User Position Type") ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
