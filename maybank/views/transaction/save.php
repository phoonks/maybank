<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <style>
        form#multiphase > #show_all_data{ display:none; }
    </style>
    <script>
        function _(x) {
            return document.getElementById(x);
        }

        function processPhase1() {
            from_account = _("from_account").value;
            available_balance = _("available_balance").value;
            to_account = _("to_account").value;
            name = _("name").value;
            amount = _("amount").value;
            details = _("details").value;
            remark = _("remark").value;
            _("phase1").style.display = "none";
            _("show_all_data").style.display = "block";
            _("display_from_account").innerHTML = from_account;
            _("display_available_balance").innerHTML = available_balance;
            _("display_to_account").innerHTML = to_account;
            _("display_name").innerHTML = name;
            _("display_amount").innerHTML = amount;
            _("display_details").innerHTML = details;
            _("display_remark").innerHTML = remark;
            _("progressBar").style.width = 100 + "%";
            _("status").innerHTML = "Phase 2 of 2";
        }

        function processBack1() {
            _("phase1").style.display = "block";
            _("show_all_data").style.display = "none";
            _("progressBar").style.width = 0 + "%";
            _("status").innerHTML = "Phase 1 of 2";
        }

        function submitForm() {
            _("multiphase").method = "post";
            _("multiphase").action = "save";
            _("multiphase").submit();
        }
    </script>
</head>
<body>
    <div class="progress">
        <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <h3 id="status">Phase 1 of 2 </h3>

    <?php $form = ActiveForm::begin([
        'id' => 'multiphase',
        'options' => [
                'onsubmit' => 'return false'
            ]
        ]); ?>

        <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div id="phase1" class="form-group" >
            <div class="form-group">
                <?= $form->field($model, 'from_account')->textInput([
                    'readonly' => true,
                    'id' => 'from_account', 
                    'value' => $model->from_account])?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'available_balance')->textInput([
                    'readonly' => true, 
                    'id' => 'available_balance',
                    'value' => $model->available_balance])?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'to_account')->textInput([
                    'id' => 'to_account']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput([
                    'id' => 'name',
                    'maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'amount')->textInput([
                    'id' => 'amount',
                    'maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'details')->textInput([
                    'id' => 'details',
                    'maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'remark')->textInput([
                    'id' => 'remark',
                    'maxlength' => true]) ?>
            </div>
            <div>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase1()']) ?>
                </span>
            </div>
        </div>

        <div id="show_all_data">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>First Name: </td>
                        <td><span id="display_from_account"></span></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><span id="display_available_balance"></span></td>
                    </tr>
                    <tr>
                        <td>Name: </td>
                        <td><span id="display_to_account"></span></td>
                    </tr>
                    <tr>
                        <td>IC: </td>
                        <td><span id="display_name"></span></td>
                    </tr>
                    <tr>
                        <td>User Name: </td>
                        <td><span id="display_amount"></span></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><span id="display_details"></span></td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td><span id="display_remark"></span></td>
                    </tr>
                </tbody>
            </table>
            <div>
                <span class="pull-left">
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack1()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'submitForm()']) ?>
                </span>
            </div>
        </div>
    </form>
    <?php ActiveForm::end(); ?>
</body>