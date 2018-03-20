<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        //'brandLabel' => Yii::$app->name,
        'brandLabel' => 'Maybank',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'About', 'url' => ['/site/about']],
            // ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Sign Up', 'url' => ['/user/save']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                ['label' => Yii::$app->user->identity->user_name, 'items' => [
                ['label' => 'View Account', 'url' => ['/account/index'], 'visible' => Yii::$app->user->identity->position === 'Admin'],
                ['label' => 'Change User Position', 'url' => ['/user/update-position'], 'visible' => Yii::$app->user->identity->position === 'Admin'],
                ['label' => 'View Account', 'url' => ['/account/useraccount'], 'visible' => Yii::$app->user->identity->position === 'User'],
                ['label' => 'Activate User', 'url' => ['/account/account'], 'visible' => Yii::$app->user->identity->position === 'Admin'],
                ['label' => 'Transaction History', 'url' => ['/transaction/index']],
                '<li class="divider"></li>',
                ['label' => 'Logout', 'url' => ['/site/logout'], 'template' => '<a href="{url}" data-method=post>{label}</a>'],
        ]]
    )]]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Maybank <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
