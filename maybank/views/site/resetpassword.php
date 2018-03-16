<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\ResetPasswordForm $model
 */
$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<script>
    function generateCode() {
        $code = rand(10000,99999);
        \Yii::$app->cache->set('code', $code, 120);
        sleep(130);
    }
</script>

<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please enter your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form'],
                'options' => ['onsubmit' => 'return false']); ?>
                
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'confirm')->passwordInput() ?>
                <?= $form->field($model, 'securitycode')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Save']) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Request Code', ['name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'generateCode']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
