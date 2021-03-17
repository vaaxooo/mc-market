<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\captcha\Captcha;
?>
<div class="row">
	<div class="col-md-4 col-sm-12">
		<div class="grid deposit-balance-card">
			<div class="grid-body">
				<div class="row">
					<div class="col-md-12 mt-4 text-center justify-content-center">
				        <div class="display-avatar animated-avatar">
				            <?= Html::img(Url::to('@web/assets/images/ava.png'), ['class' => 'profile-img img-lg ']) ?>
				        </div>
					</div>
					<div class="col-md-12 text-center mt-4">
						<h5 class="font-weight-medium"><?= Html::encode($userData->firstname.' '.$userData->lastname) ?></h5>
						<h4 class="font-weight-medium text-success"><b class="text-success"><?= count($rating) ?> <i class="mdi mdi-star-circle"></i></b></h4>
					</div>
				</div>
			</div>
		</div>

		<div class="grid mt-2">
			<div class="grid-body">
				<ul class="user-information">
					<li><b>E-mail:</b> <?= Html::encode($userData->email) ?></li>
					<li><b>Зарегистрирован:</b> <?= Html::encode($userData->date) ?></li>
					<li><b>Товаров добавлено:</b> <?= count($items) ?></li>
				</ul>
			</div>
		</div>

	</div>


	<div class="col-md-8 col-sm-12">
		<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
		<?php Pjax::begin(); ?>
				<?php if(Yii::$app->session->hasFlash('error')): ?>
					<div class="alert alert-warning">
						<?= Yii::$app->session->getFlash('error') ?>
					</div>
				<?php endif ?>

				<div class="grid">
					<p class="grid-header">Оценить пользователя</p>
					<div class="grid-body">
						<div class="item-wrapper">
							<?= $form->field($model, 'captcha')->widget(Captcha::className()) ?>
    						<?= Html::submitButton("Оценить пользователя", ['class' => 'btn btn-sm btn-block mt-4 btn-success']) ?>

						</div>
					</div>
				</div>
		<?php Pjax::end() ?>
		<?php ActiveForm::end() ?>

		<?php if($items != null): ?>
			<div class="table-responsive mt-2">
				<table class="table table-hover table-sm">
					<tbody>
						<?php foreach($items as $item): ?>
							<tr class="grid">
								<td>
									<span class="icon-fg" style="background-image: url('<?= Url::to('@web/favicon.ico') ?>');"></span>
								</td>
								<td>
									<small class="text-black font-weight-medium"><?= Html::encode($item->name) ?></small> 
									<span class="text-gray">
										<span class="status-indicator rounded-indicator small bg-success"></span> <?= Html::encode($item->small_description) ?>
									</span>
								</td>
								<td>
									<small>Версия: <b class="text-success"><?= Html::encode($item->version) ?></b></small>
								</td>
								<td>
									<small>Стоимость: <b class="text-success"><?php if($item->price != 0): echo Html::encode($item->price).' <i class="mdi mdi-database-plus"></i>'; else: echo "Бесплатно"; endif; ?></b></small>
								</td>
								<td><a href="<?= Url::to('/mcpe/plugins/view/'.$item->id) ?>" class="text-success">Посмотреть</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

	</div>


</div>