<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Cabinet;
use app\models\Notifications;

AppAsset::register($this);
$userData = Cabinet::find()->where(['email' => Yii::$app->session['email']])->one();
$notifications = Notifications::find()->where(['account' => Yii::$app->session['email']])->orderBy(['id' => SORT_DESC])->limit(4)->all();
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
    <style>
      .text-success{
        color: #6bb1f1;
      }
    </style>
</head>
<body class="header-fixed">
<?php $this->beginBody() ?>
    <nav class="t-header">
      <div class="t-header-brand-wrapper justify-content-center">
        <a href="index.html">
          <logo class="logo text-dark"><b>MC</b>-<b class="text-success">MARKET</b></logo>
          <logo class="logo-mini text-dark">MM<logo>
        </a>
      </div>
      <div class="t-header-content-wrapper">
        <div class="t-header-content">
          <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
            <i class="mdi mdi-menu"></i>
          </button>
          <ul class="nav ml-auto">




              <?php if(isset(Yii::$app->session['email'])): ?>

                <li class="nav-item dropdown">
                  <a class="nav-link text-dark" href="#" id="notificationDropdown" data-toggle="dropdown" aria-expanded="false">
                    <?php if($notifications != null): ?>
                      <span class="status-indicator rounded-indicator small bg-success display-avatar animated-avatar"></span>
                    <?php endif; ?>
                    <i class="mdi mdi-bell mdi-1x"></i>
                  </a>
                  <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="notificationDropdown">
                    <div class="dropdown-header">
                      <h6 class="dropdown-title">Сообщения</h6>
                    </div>
                    <div class="dropdown-body">
                      <?php if($notifications != null): ?>
                        <?php foreach($notifications as $notif): ?>
                        <div class="dropdown-list">
                          <div class="icon-wrapper rounded-circle bg-inverse-success text-success">
                            <i class="mdi mdi-check"></i>
                          </div>
                          <div class="content-wrapper">
                            <small class="name"><?= Html::encode($notif->title) ?></small>
                            <small class="content-text"><?= Html::encode($notif->message) ?></small>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                        <div class="dropdown-list">
                            <small class="text-center text-muted">У вас нет сообщений..</small>
                        </div>
                    <?php endif; ?>
                    </div>
                  </div>
                </li>
            <?php endif; ?>
            
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="appsDropdown" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-apps mdi-1x"></i>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="appsDropdown">
                <div class="dropdown-header">
                  <h6 class="dropdown-title">Выберите игру</h6>
                  <p class="dropdown-title-text mt-2">Площадка плагинов, карт и многое другое</p>
                </div>
                <div class="dropdown-body border-top pt-0">
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-briefcase-check mdi-2x"></i>
                    <span class="grid-tittle">MСPE</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-briefcase-check mdi-2x"></i>
                    <span class="grid-tittle">MСPC</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-alert mdi-2x"></i>
                    <span class="grid-tittle">Скоро</span>
                  </a>
                  <a class="dropdown-grid">
                    <i class="grid-icon mdi mdi-alert mdi-2x"></i>
                    <span class="grid-tittle">Скоро</span>
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>








    <!-- partial -->
    <div class="page-body">
      <!-- partial:partials/_sidebar.html -->
      <div class="sidebar">
          <?php if(isset(Yii::$app->session['email'])): ?>
            <div class="user-profile">
              <div class="display-avatar animated-avatar">
                <?= Html::img(Url::to('@web/assets/images/ava.png'), ['class' => 'profile-img img-lg ']) ?>
              </div>
              <div class="info-wrapper">
                <p class="user-name"><span class="status-indicator rounded-indicator small bg-success"></span> <?= Html::encode($userData->firstname.' '.$userData->lastname) ?></p>
                <h6 class="display-income text-dark"><?= Html::encode($userData->balance) ?> <img src="/assets/images/gold_coins.png" width="26px" height="20px" style="margin-bottom: 3px"></h6>
              </div>
            </div>
          <?php endif; ?>

        <ul class="navigation-menu">
          <li class="nav-category-divider">Площадка</li>
          <?php if(isset(Yii::$app->session['email'])): ?>
            <li>
              <a href="<?= Url::to('/index') ?>">
                <span class="link-title">Главная страница</span>
                <i class="mdi mdi-home link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/ru/analysis') ?>">
                  <span class="link-title top">Анализ плагинов</span>
                  <i class="mdi mdi-flask link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/trade') ?>">
                  <span class="link-title">Торговая площадка</span>
                  <i class="mdi mdi-briefcase-check link-icon"></i>
              </a>
            </li>
            <li>
              <a href="#ui-elements" data-toggle="collapse" aria-expanded="false">
                <span class="link-title">Профиль</span>
                <i class="mdi mdi-account-convert link-icon"></i>
              </a>
              <ul class="collapse navigation-submenu" id="ui-elements">
                <li>
                  <a href="<?= Url::to('/cabinet/index') ?>">Профиль</a>
                </li>
                <li>
                  <a href="<?= Url::to('/cabinet/pay') ?>">Пополнение баланса</a>
                </li>
                <li>
                  <a href="<?= Url::to('/cabinet/payout') ?>">Вывод средств</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?= Url::to('/docs') ?>">
                <span class="link-title">Помощь</span>
                <i class="mdi mdi-file-document-box link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/cabinet/logout') ?>">
                <span class="link-title">Выйти из системы</span>
                <i class="mdi mdi-logout-variant link-icon"></i>
              </a>
            </li>
          <?php endif; ?>


          <?php if(!isset(Yii::$app->session['email'])): ?>
            <li>
              <a href="<?= Url::to('/ru/analysis') ?>">
                  <span class="link-title text-warning top">Анализ плагинов</span>
                  <i class="mdi mdi-flask link-icon text-warning"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/trade') ?>">
                  <span class="link-title">Торговая площадка</span>
                  <i class="mdi mdi-briefcase-check link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/cabinet/login') ?>">
                <span class="link-title">Авторизация</span>
                <i class="mdi mdi-login-variant link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/cabinet/register') ?>">
                <span class="link-title">Регистрация</span>
                <i class="mdi mdi-account-plus link-icon"></i>
              </a>
            </li>
            <li>
              <a href="<?= Url::to('/docs') ?>">
                <span class="link-title">Помощь</span>
                <i class="mdi mdi-file-document-box link-icon"></i>
              </a>
            </li>
          <?php endif; ?>

          <?php if(isset(Yii::$app->session['admin'])): ?>
              <li class="nav-category-divider">Администратор</li>
              <li>
                <a href="<?= Url::to('/admin/users') ?>">
                    <span class="link-title">Пользователи</span>
                    <i class="mdi mdi-account-key link-icon"></i>
                </a>
              </li>
              <li>
                <a href="<?= Url::to('/admin/items') ?>">
                    <span class="link-title">Товары</span>
                    <i class="mdi mdi-coin link-icon"></i>
                </a>
              </li>
          <?php endif; ?>

          <li class="nav-category-divider">Контакты</li>
          <div class="row">
            <div class="col-md-12 justify-content-center text-center">
              <a class="btn btn-social btn-inverse-dark btn-sm" href="#">
                <i class="mdi mdi-vk"></i>
              </a>
              <a class="btn btn-social btn-inverse-dark btn-sm" href="https://vk.com/mcmarketplace">
                <i class="mdi mdi-vk"></i>
              </a>
              <a class="btn btn-social btn-inverse-dark btn-sm" href="https://vk.com/im?media=&sel=-112783625">
                <i class="mdi mdi-headset"></i>
              </a>
            </div>
          </div>

        </ul>
      </div>
















      <!-- partial -->
      <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
          <div class="content-viewport">
            <div class="row">
              <div class="col-12 py-5">
                <h4 class="text-uppercase"><?= Html::encode($this->title) ?></h4>
                <p class="text-gray">Торговая площадка Minecraft и Minecraft PE</p>
              </div>
            </div>


             <?= $content ?>


          </div>
        </div>
        <!-- content viewport ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="row">
            <div class="col-sm-6 text-center text-sm-right order-sm-1">
              <ul class="text-gray">
                <li><a href="#">Условия использования</a></li>
              </ul>
            </div>
            <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
              <small class="text-muted d-block">Copyright © 2019 MINECRAFT MARKET. All rights reserved</small>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- page content ends -->
    </div>
    <!--page body ends -->

   
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
