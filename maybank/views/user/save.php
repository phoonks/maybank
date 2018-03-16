<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <style>
        form#multiphase > #phase2, #phase3, #phase4, #phase5, #show_all_data{ display:none; }
    </style>
    <script>
        function _(x) {
            return document.getElementById(x);
        }

        function processPhase1() {
            firstname = _("first_name").value;
            lastname = _("last_name").value;
            name = _("name").value;
            ic = _("identity_card").value;
            if(firstname.length > 2 && lastname.length > 2 && name.length > 2 && ic.length > 2) {
                _("phase1").style.display = "none";
                _("phase2").style.display = "block";
                _("progressBar").style.width = 20 + "%";
                _("status").innerHTML = "Phase 2 of 6";
            }else {
                alert("Please fill in the fields");
            }
        }

        function processBack1() {
            _("phase1").style.display = "block";
            _("phase2").style.display = "none";
            _("progressBar").style.width = 0 + "%";
            _("status").innerHTML = "Phase 1 of 6";
        }

        function processPhase2() {
            username = _("user_name").value;
            password = _("password").value;
            if(username.length > 2 && password.length > 2) {
                _("phase2").style.display = "none";
                _("phase3").style.display = "block";
                _("progressBar").style.width = 40 + "%";
                _("status").innerHTML = "Phase 3 of 6";
            }else {
                alert("Please fill in the fields");
            }
        }

        function processBack2() {
            _("phase2").style.display = "block";
            _("phase3").style.display = "none";
            _("progressBar").style.width = 20 + "%";
            _("status").innerHTML = "Phase 2 of 6";
        }

        function processPhase3() {
            phoneno = _("phone_no").value;
            email = _("email").value;
            date_of_birth = _("date_of_birth").value;
            position = _("signupform-position").value;
            if(position.length > 0 && phoneno.length > 2 && email.length > 2 && date_of_birth.length > 2) {
                _("phase3").style.display = "none";
                _("phase4").style.display = "block";
                _("progressBar").style.width = 60 + "%";
                _("status").innerHTML = "Phase 4 of 6";
            }else {
                alert("Please fill in the fields");
            }
        }

        function processBack3() {
            _("phase3").style.display = "block";
            _("phase4").style.display = "none";
            _("progressBar").style.width = 40 + "%";
            _("status").innerHTML = "Phase 3 of 6";
        }

        function processPhase4() {
            postcode = _("postcode").value;
            country = _("signupform-country").value;
            city = _("signupform-city").value;
            state = _("signupform-state").value;
            address = _("address").value;
            if(postcode.length > 0 && country.length > 0 && city.length > 0 && state.length > 0 && address.length > 0) {
                _("phase4").style.display = "none";
                _("phase5").style.display = "block";
                _("progressBar").style.width = 80 + "%";
                _("status").innerHTML = "Phase 5 of 6";
            }else {
                alert("Please fill in the fields");
            }
        }

        function processBack4() {
            _("phase4").style.display = "block";
            _("phase5").style.display = "none";
            _("progressBar").style.width = 60 + "%";
            _("status").innerHTML = "Phase 4 of 6";
        }

        function processPhase5() {
            account_number = _("account_number").value;
            current_balance = _("current_balance").value;
            account_type = _("signupform-account_type").value;
            if(account_number.length > 0 && current_balance.length > 0) {
                _("phase5").style.display = "none";
                _("show_all_data").style.display = "block";
                _("display_firstname").innerHTML = firstname;
                _("display_lastname").innerHTML = lastname;
                _("display_name").innerHTML = name;
                _("display_ic").innerHTML = ic;
                _("display_username").innerHTML = username;
                _("display_password").innerHTML = password;
                _("display_phoneno").innerHTML = phoneno;
                _("display_email").innerHTML = email;
                _("display_date_of_birth").innerHTML = date_of_birth;
                _("display_position").innerHTML = position;
                _("display_postcode").innerHTML = postcode;
                _("display_country").innerHTML = country;
                _("display_city").innerHTML = city;
                _("display_state").innerHTML = state;
                _("display_address").innerHTML = address;
                _("display_account_number").innerHTML = account_number;
                _("display_current_balance").innerHTML = current_balance;
                _("display_account_type").innerHTML = account_type;
                _("progressBar").style.width = 100 + "%";
                _("status").innerHTML = "Phase 6 of 6";
            }else {
                alert("Please fill in the fields");
            }
        }

        function processBack5() {
            _("phase5").style.display = "block";
            _("show_all_data").style.display = "none";
            _("progressBar").style.width = 80 + "%";
            _("status").innerHTML = "Phase 5 of 6";
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
    <h3 id="status">Phase 1 of 6 </h3>

    <?php $form = ActiveForm::begin([
        'id' => 'multiphase',
        'options' => [
                'onsubmit' => 'return false'
            ]
        ]); ?>

        <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div id="phase1" class="form-group" >
            <div class="form-group">
                <?= $form->field($model, 'first_name')->textInput([
                    'maxlength' => true,
                    'id' => 'first_name',
                    'placeholder' => 'Enter Your First Name'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'last_name')->textInput([
                    'maxlength' => true,
                    'id' => 'last_name',
                    'placeholder' => 'Enter Your Last Name'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput([
                    'maxlength' => true,
                    'id' => 'name',
                    'placeholder' => 'Enter Your Name'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'identity_card')->textInput([
                    'maxlength' => true,
                    'id' => 'identity_card',
                    'placeholder' => 'Enter Your IC'
                    ]) ?>
            </div>
            <div>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase1()']) ?>
                </span>
            </div>
        </div>

        <div id="phase2" class="form-group">
            <div class="form-group">
                <?= $form->field($model, 'user_name')->textInput([
                    'maxlength' => true,
                    'id' => 'user_name',
                    'placeholder' => 'Enter Your User Name'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput([
                    'maxlength' => true,
                    'id' => 'password',
                    'placeholder' => 'Enter Your Password'
                    ]) ?>
            </div>
            <div>
                <span class="pull-left">
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack1()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase2()']) ?>
                </span>
            </div>
        </div>

        <div id="phase3" class="form-group">
            <div class="form-group">
                <?= $form->field($model, 'phone_no')->textInput([
                    'maxlength' => true,
                    'id' => 'phone_no',
                    'placeholder' => 'Enter Your Phone Number'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'email')->textInput([
                    'maxlength' => true,
                    'id' => 'email',
                    'placeholder' => 'Enter Your Email'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'date_of_birth')->textInput([
                    'maxlength' => true,
                    'id' => 'date_of_birth',
                    'placeholder' => 'Enter Your date_of_birth'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'position')->dropDownList([
                    'Admin' => 'Admin', 
                    'User' => 'User']) 
                    ->hint("Select Your Position") ?>
            </div>
            <div>
                <span class="pull-left">
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack2()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase3()']) ?>
                </span>
            </div>
        </div>

        <div id="phase4" class="form-group">
            <div class="form-group">
                <?= $form->field($model, 'address')->textInput([
                    'maxlength' => true,
                    'id' => 'address',
                    'placeholder' => 'Enter Your Address'
                    ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'country')->dropDownList([
                    'Malaysia' => 'Malaysia', 
                    'India' => 'India']) 
                    ->hint("Select Your Country") ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'city')->dropDownList([
                    'Kuala Lumpor' => 'Kuala Lumpor', 
                    'Johor' => 'Johor']) 
                    ->hint("Select Your City") ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'state')->dropDownList([
                    'Ulu Tiram' => 'Ulu Tiram', 
                    'Johor Bahru' => 'Johor Bahru']) 
                    ->hint("Select Your Country") ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'postcode')->textInput([
                    'maxlength' => true,
                    'id' => 'postcode',
                    'placeholder' => 'Enter Your Postcode'
                    ]) ?>
            </div>
            <div>
                <span class="pull-left">
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack3()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase4()']) ?>
                </span>
            </div>
        </div>

        <div id="phase5" class="form-group">
            <div class="form-group">
                <?= $form->field($model, 'account_number')->textInput([
                    'maxlength' => true,
                    'id' => 'account_number',
                    'placeholder' => 'Enter Your Account Number'
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
                <span class="pull-left">
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack4()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'processPhase5()']) ?>
                </span>
            </div>
        </div>

        <div id="show_all_data">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>First Name: </td>
                        <td><span id="display_firstname"></span></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><span id="display_lastname"></span></td>
                    </tr>
                    <tr>
                        <td>Name: </td>
                        <td><span id="display_name"></span></td>
                    </tr>
                    <tr>
                        <td>IC: </td>
                        <td><span id="display_ic"></span></td>
                    </tr>
                    <tr>
                        <td>User Name: </td>
                        <td><span id="display_username"></span></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><span id="display_password"></span></td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td><span id="display_phoneno"></span></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><span id="display_email"></span></td>
                    </tr>
                    <tr>
                        <td>Date Of Birth: </td>
                        <td><span id="display_date_of_birth"></span></td>
                    </tr>
                    <tr>
                        <td>Position: </td>
                        <td><span id="display_position"></span></td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td><span id="display_address"></span></td>
                    </tr>
                    <tr>
                        <td>Country: </td>
                        <td><span id="display_country"></span></td>
                    </tr>
                    <tr>
                        <td>City: </td>
                        <td><span id="display_city"></span></td>
                    </tr>
                    <tr>
                        <td>State: </td>
                        <td><span id="display_state"></span></td>
                    </tr>
                    <tr>
                        <td>Postcode: </td>
                        <td><span id="display_postcode"></span></td>
                    </tr>
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
                    <?= Html::submitButton('Back', ['class' => 'btn btn-success', 'onclick' => 'processBack5()']) ?>
                </span>
                <span class="pull-right">
                    <?= Html::submitButton('Continue', ['class' => 'btn btn-success', 'onclick' => 'submitForm()']) ?>
                </span>
            </div>
        </div>
    </form>
    <?php ActiveForm::end(); ?>
</body>