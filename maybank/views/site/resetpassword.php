<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\ResetPasswordForm $model
 */
$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please enter your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                // 'layout' => 'horizontal'
                ]); ?>
                
                <div class="col-lg-12">
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'confirm')->passwordInput(['placeholder' => 'Confirm Password'])->label(false) ?>
                </div>
                <!-- <div class="row"> -->
                <div class="col-lg-8">
                    <?= $form->field($model, 'securitycode')->passwordInput(['placeholder' => 'Security Code'])->label(false) ?>
                </div>
                <div class="col-lg-4">
                    <?= Html::submitButton('Request Code', ['name' => 'submit2', 'class' => 'btn btn-primary', 'value' => 'submit2']) ?>
                </div>
                <!-- </div> -->
        </div>
    </div>
    <div class="col-lg-6">
    <?= Html::submitButton('Save', ['name' => 'submit1', 'class' => 'btn btn-primary', 'value' => 'submit1']) ?>
</div>
            <?php ActiveForm::end(); ?>
</div>
