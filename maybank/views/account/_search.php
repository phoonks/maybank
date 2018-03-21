<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccountholderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accountholder-search" class = "rol-lg-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'inline'
    ]); ?>
    <div class = "col-lg-2">
	    <?= $form->field($model, 'id')->textInput(['placeholder' => 'Enter ID']) ?>
    </div>
	<div class = "col-lg-2">
	    <?= $form->field($model, 'user_id')->textInput(['placeholder' => 'Enter User ID']) ?>
	</div>
	<div class = "col-lg-2">
	    <?= $form->field($model, 'account_number')->textInput(['placeholder' => 'Enter Account Number']) ?>
	</div>
	<div class = "col-lg-2">
	    <?= $form->field($model, 'account_type')->textInput(['placeholder' => 'Enter Account Type']) ?>
    </div>
	<div class = "col-lg-2">
	    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
	</div>
	<br/>
	<?php ActiveForm::end(); ?>
</div>

