<?php


use yii\helpers\Html;
use yii\helpers\Url;
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
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="header-fixed">
<?php $this->beginBody() ?>


<div class="authentication-theme auth-style_1">
    <div class="row">
      <div class="col-12 logo-section">
        <a class="logo">
          <h3><b>MC</b>-<b class="text-success">Market</b></h3>
        </a>
      </div>
    </div>

  <div class="row">
    <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">

      <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-warning">
          <?= Yii::$app->session->getFlash('error') ?>
        </div>
      <?php endif ?>
      <div class="grid">
        <div class="grid-body">


          <div class="row">
              <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">


                <?= $content ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="auth_footer"><p class="text-muted text-center">© MINECRAFT MARKET 2019</p></div>

</div>
   

<?php

$script = <<< JS
	setTimeout("$('.alert').hide()", 5000);
JS;

$this->registerJs($script, yii\web\View::POS_READY);
?>

<?php $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js',  ['position' => yii\web\View::POS_HEAD]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
