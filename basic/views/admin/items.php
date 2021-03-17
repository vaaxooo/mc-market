<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
?>

<div class="col-lg-12 col-md-12 col-sm-12">


    <div class="table-responsive mt-2">
        <table class="table table-hover table-sm">
            <tbody>
                <?php if($items != null): ?>
                    <?php foreach($items as $item): ?>
                        <tr class="grid">
                            <td>
                                <img class="img-sm" src="<?= Url::to("@web/favicon.ico"); ?>">
                            </td>
                            <td>
                                <small class="text-black font-weight-medium"><?= Html::encode($item->name) ?></small> 
                                <span class="text-gray"><?= Html::encode($item->small_description) ?></span>
                            </td>
                            <td><b>Стоимость: </b>
                                <b class="text-success">
                                    <?php if($item->price == 0): ?>Бесплатно<?php else: ?><?= Html::encode($item->price) ?> <i class="mdi mdi-database-plus"></i><?php endif; ?>
                                </b>
                            </td>
                            <td><a href="<?= Url::to("/cabinet/items/info/".$item->id) ?>" class="text-success">Посмотреть</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                        <td>
                            <td><h5>Список товаров пуст..</h5></td>
                        </tr>
                <?php endif; ?>
            </tbody>
        </table>

            <strong class="text-center justify-content-center dataTables_paginate paging_simple_numbers pagination mt-5">
                <?= LinkPager::widget(['pagination' => $pages]); ?>
            </strong>

    </div>
</div>