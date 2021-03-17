<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\IndexAsset;


IndexAsset::register($this);
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
<body class="theme-fern loaded" data-spy="scroll" data-target="#navbar-nav" data-animation="false" data-appearance="light" data-gr-c-s-loaded="true">
<?php $this->beginBody() ?>


    <main class="main">
        <!-- =========== Start of Navigation (main menu) ============ -->
        <header class="navbar navbar-sticky navbar-expand-lg navbar-light">
            <div class="container position-relative">
                <a class="navbar-brand" href="#">

                    <h5 class="navbar-brand__regular"><b class="text-success">MC</b><b>-Market</b></h5>
                    <h5 class="navbar-brand__sticky"><b class="text-success">MC</b><b>-Market</b></h5>
                </a>
                <!--  End of brand logo -->
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- end of Nav toggler -->

                <div class="navbar-inner">
                    <!--  Nav close button inside off-canvas/ mobile menu -->
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- end of Nav Toggoler -->
                    <nav>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to('/ru/analysis') ?>">Анализ плагинов</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::to('/trade') ?>">Торговая площадка</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Условия использования</a>
                            </li>

                        </ul>
                        <!-- end of nav menu items -->
                    </nav>
                </div>
                <div class="d-flex align-items-center ml-lg-1 ml-xl-2 mr-4 mr-sm-6 m-lg-0">
                    <a href="<?= Url::to('/trade') ?>" class="color--primary font-w--600 mr-2 d-none d-sm-inline-block">Покупатель</a>
                    <a href="<?= Url::to('/cabinet/login') ?>" class="btn btn-size--md btn-bg--primary rounded--none btn-hover--3d">
                        <span class="btn__text font-w--500">Продавец</span>
                    </a>
                </div>
            </div>
            <!-- end of container -->
        </header>
        <!-- =========== End of Navigation (main menu)  ============ -->


				<?= $content; ?>



       

       
        <!-- =========== Start of footer height emulator============ -->
        <!-- this height emulator helps to calculate the fixed footer height  -->
        <div class="height-emulator d-none d-lg-block" style="height: 585px;"></div>
        <!-- =========== End of footer height emulator============ -->

        <!-- =========== Start of Footer ============ -->
        <footer class="space footer footer--fixed section--light hidden">
            <div class="container">
                <h5 class="text-dark text-center">© MC-Market, 2019.</h5>
            </div>
        </footer>
        <!-- =========== End of Footer ============ -->
    </main>

<?php $this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js',  ['position' => yii\web\View::POS_HEAD]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>