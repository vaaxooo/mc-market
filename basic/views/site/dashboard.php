<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
?>


        <!-- =========== Start of Hero ============ -->
        <section class="hero hero--v1 d-flex align-items-center hidden">
            <div class="section-overlap border-top bg-color--primary-light--1 pos-abs-bottom jsElement" style="height: 285px;"></div>
            <!-- end of section overlap bg -->
            <div class="container">
                <div class="row flex-column-reverse flex-lg-row">
                    <div class="col-12 col-md-10 col-lg-7 mx-auto text-center z-index2">
                        <div class="hero-content reveal">
                            <h1 class="hero__title h2-font font-w--500 mb-2">Сделайте свои игровые сервера уникальными!</h1>
                            <p class="hero__description text-color--700 opacity--70 font-size--20 mb-3 mb-lg-4">На нашем сайте вы сможете найти игровые улучшения, плагины, карты и сделать сервер особенным!</p>
                            <!-- end of text content -->
                            <a href="<?= Url::to('/trade') ?>" class="btn btn-size--md rounded--none btn-border btn-border--color--primary color--primary btn-hover--primary">
                                <span class="btn__text font-w--500">Торговая площадка</span>
                            </a>
                            <!-- end of button -->
                        </div>
                        <!-- end of content -->
                    </div>
                    <!-- end of col -->
                </div>
                <!-- end of row -->
                <div class="row">
                    <div class="col-12">
                        <div class="hero__image jsElement" style="margin-top: -35px;">
                            <picture><?= Html::img(Url::to('@web/main-assets/images/illustration-25.png'), ['class' => 'img-fluid']) ?></picture>
                        </div>
                    </div>
                    <!-- end of col -->
                </div>
                <!-- end of row -->
            </div>
        </section>
        <!-- =========== End of Hero ============ -->


        <!-- =========== Start of Features ============ -->
        <section class="space reveal">
            <div class="container">
                <div class="row card--v1">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="card card-hover--shadow p-3 p-md-2 p-lg-4 rounded--none h-100">
                            <span class="mb-3"><?= Html::img(Url::to('@web/main-assets/images/icon-device.svg')) ?></span>
                            <h3 class="font-size--20 mb-2">Анализ кода плагинов</h3>
                            <p class="font-size--15">Перед тем как поставить скачанный плагин на свой игровой сервер, вы можете проверить его на вредоносные коды на нашем сайте в разделе "Анализ плагинов".</p>
                        </div>
                    </div>
                    <!-- end of col -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="card card-hover--shadow p-3 p-md-2 p-lg-4 rounded--none h-100">
                            <span class="mb-3"><?= Html::img(Url::to('@web/main-assets/images/icon-assets.svg')) ?></span>
                            <h3 class="font-size--20 mb-2">Рейтинг пользователя</h3>
                            <p class="font-size--15">Чем выше рейтинг профиля, тем больше доверия у покупателей к продавцу! Ваш рейтинг можно узнать в вашем профиле или по персональной ссылке.</p>
                        </div>
                    </div>
                    <!-- end of col -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="card card-hover--shadow p-3 p-md-2 p-lg-4 rounded--none h-100">
                            <span class="mb-3"><?= Html::img(Url::to('@web/main-assets/images/icon-secure.svg')) ?></span>
                            <h3 class="font-size--20 mb-2">Продажа товаров</h3>
                            <p class="font-size--15">Любой товар на нашем сайте перед публикацией проходит проверку модерацией MC-Market. <br>Мы предоставляем гарантию, что после оплаты вы получите моментально ваш товар!</p>
                        </div>
                    </div>
                    <!-- end of col -->
                </div>
                <!-- end of row -->
                <div class="row card--v1 flex-column-reverse flex-md-row">
                    <div class="col-12 col-md-8 mb-3 mb-md-0">
                        <div class="card p-3 p-md-2 p-lg-4 pr-lg-10 rounded--none h-100 align-items-start justify-content-center">
                            <span class="mb-1 text-color--400">Нет навыков программирования? Нет проблем!</span>
                            <h3 class="font-size--26 mb-2">Почему именно мы?</h3>
                            <p class="font-size--15 mb-4">Цель нашего проекта: честные и прозрачные приобретения игровых улучшений, карт и плагинов для проектов MC:PE и MC:PC.
                            <br>• Мы гарантируем, что ваши средства не уйдут в карманы мошенников
                            <br>• Мы предоставляем возможность получать обновления для купленных товаров
                            <br>• Мы предоставляем возможность заработать за определённое количество скачиваний игровых улучшений, карт или плагинов!</p>
                            <a href="<?= Url::to('/trade') ?>" class="btn btn-size--md btn-bg--dark btn-hover--primary rounded--none"><span class="btn__text font-w--500">Торговая площадка</span></a>
                        </div>
                    </div>
                    <!-- end of col -->
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="card card-hover--shadow p-3 p-md-2 p-lg-4 rounded--none h-100">
                            <span class="mb-3"><?= Html::img(Url::to('@web/main-assets/images/icon-ecommerce.svg')) ?></span>
                            <h3 class="font-size--20 mb-2">Прибыль с скачиваний</h3>
                            <p class="font-size--15">Наш сайт платит автору товара 10 рублей за 500 скачиваний игровых улучшений, карт или плагинов.</p>
                        </div>
                    </div>
                    <!-- end of col -->
                </div>
            </div>
        </section>
        <!-- =========== End of Features ============ -->

