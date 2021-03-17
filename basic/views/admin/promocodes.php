<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
?>
<div class="row">




<div class="col-md-4 col-sm-12">
<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
<?php Pjax::begin(); ?>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger animated fadeInDown">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif ?>



	<div class="card card-shadow mb-3">
		<div class="card-body">
        <div class="card-title"><h5 class="text-uppercase"><i class="fa fa-plus text-super"></i> <?= Yii::t('language', 'Новый промокод') ?></h5></div>
                    <div class="form-group my-3">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('language', 'Введите название промокода'), 'class' => "form-control"])->label(false); ?>
                    </div>
                    <div class="form-group my-3">
                        <?= $form->field($model, 'percent')->textInput(['placeholder' => Yii::t('language', 'Введите процент промокода'), 'class' => "form-control"])->label(false); ?>
                    </div>
					<div class="form-group">
                        <?= Html::submitButton(Yii::t('language', 'Добавить промокод'), ['class' => 'btn btn-block btn-super-green-fx']) ?>
					</div>

		</div>
	</div>


<?php Pjax::end() ?>
<?php ActiveForm::end() ?>
</div>







<div class="col-md-8 col-sm-12">
<?php if($promocodes != null): ?>
    <?php foreach($promocodes as $promocode): ?>
        <div class="card card-shadow mb-1 zoomer">
            <div class="card-body">
                <div class="d-flex flex-column flex-sm-row flex-wrap">

                    <sect class="servers-link"><?= Yii::t('language', 'Название') ?>: <b><?= Html::encode($promocode->name) ?></b></sect>
                    <sect class="servers-link ml-5"><?= Yii::t('language', 'Процент') ?>: <b><?= Html::encode($promocode->percent) ?>%</b></sect>
                    <sect class="servers-link ml-5"><a href="<?= Url::to('/admin/promocodes/delete/'.$promocode->id) ?>" data-confirm="<?= Yii::t('language', 'Вы действительно хотите удалить промокод?')?>"><i class="fa fa-trash text-super-red"></i></a></sect>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="card card-shadow mb-1 zoomer">
        <div class="card-body text-center">
            <h3 class="text-center"><?= Yii::t('language', 'Список промокодов пуст..') ?></h3>
        </div>
    </div>
<?php endif; ?>
</div>


</div>