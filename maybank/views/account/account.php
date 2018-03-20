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
            account_number = _("account_number").value;
            current_balance = _("current_balance").value;
            account_type = _("signupform-account_type").value;
            if(_("current_balance").value >= 200) {
                _("phase1").style.display = "none";
                _("show_all_data").style.display = "block";
                _("display_account_number").innerHTML = account_number;
                _("display_current_balance").innerHTML = current_balance;
                _("display_account_type").innerHTML = account_type;
                _("progressBar").style.width = 100 + "%";
                _("status").innerHTML = "Phase 2 of 2";
            }else {
                alert("Current Balance must more than or equal 200");
            }
        }

        function processBack1() {
            _("phase1").style.display = "block";
            _("show_all_data").style.display = "none";
            _("progressBar").style.width = 0 + "%";
            _("status").innerHTML = "Phase 1 of 2";
        }

        function submitForm() {
            _("multiphase").method = "post";
            _("multiphase").action = "account";
            _("multiphase").submit();
        }
    </script>
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

        <div id="phase1" class="form-group">
            <div class="form-group">
                <?= $form->field($model, 'user_name')->dropDownList($listData)->label('User Name')->hint("Select User Name") ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'account_number')->textInput([
                    'maxlength' => true,
                    'id' => 'account_number',
                    'value' => $model->account_number,
                    'readonly' => true
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'account_type')->dropDownList([
                    'Fixed Account' => 'Fixed Account', 
                    'Saving Account' => 'Saving Account']) 
                    ->hint("Select Your Account Type") ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'current_balance')->textInput([
                    'maxlength' => true,
                    'id' => 'current_balance',
                    'placeholder' => 'Enter the Balance'
                    ]) ?>
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
                        <td>Account Number: </td>
                        <td><span id="display_account_number"></span></td>
                    </tr>
                    <tr>
                        <td>Current Balance: </td>
                        <td><span id="display_current_balance"></span></td>
                    </tr>
                    <tr>
                        <td>Account Type: </td>
                        <td><span id="display_account_type"></span></td>
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