<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
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
						<h4 class="font-weight-medium text-success"><?= Html::encode($userData->balance) ?> <i class="mdi mdi-database-plus"></i></h4>
					</div>
					<div class="col-6">
						<a href="<?= Url::to('/cabinet/pay') ?>"><button type="button" class="btn btn-sm btn-block mt-4 btn-success"><i class="mdi mdi-database-plus"></i> Пополнить</button></a>
					</div>
					<div class="col-6">
						<a href="<?= Url::to('/cabinet/payout') ?>"><button type="button" class="btn btn-sm btn-block mt-4 btn-success"><i class="mdi mdi-database-minus"></i> Вывод средств</button></a>
					</div>
				</div>
			</div>
		</div>

		<div class="grid mt-2">
			<div class="grid-body">
				<ul class="user-information">
					<li><b>E-mail:</b> <?= Html::encode($userData->email) ?></li>
					<li><b>Зарегистрирован:</b> <?= Html::encode($userData->date) ?></li>
					<li><b>Ваш рейтинг:</b> <b class="text-success"><?= count($rating) ?> <i class="mdi mdi-star-circle"></i></b></li>
					<li><b><i class="mdi mdi-сheck text-success"></i> Ваш URL:</b> <small><a href="https://trademc.xyz/info/<?= Html::encode($userData->id) ?>" class="text-success">https://trademc.xyz/info/<?= Html::encode($userData->id) ?></a></small></li>
				</ul>
			</div>
		</div>

	</div>


	<div class="col-md-8 col-sm-12">

		<?php if(Yii::$app->session->hasFlash('errorChange')): ?>
			<div class="alert alert-warning">
				<?= Yii::$app->session->getFlash('errorChange') ?>
			</div>
		<?php endif ?>

		<?php if(Yii::$app->session->hasFlash('error')): ?>
			<div class="alert alert-warning">
				<?= Yii::$app->session->getFlash('error') ?>
			</div>
		<?php endif ?>

		<div class="grid">
			<p class="grid-header">Смена пароля</p>
			<div class="grid-body">
				<div class="item-wrapper">
					<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
					<?php Pjax::begin(); ?>
						<div class="form-group row showcase_row_area">
							<div class="col-md-3 showcase_text_area">
								<label for="inputEmail4">Текущий пароль</label>
							</div>
							<div class="col-md-9 showcase_content_area">
								<?= $form->field($model, 'current_password')->passwordInput(['class' => "form-control", 'placeholder' => 'Текущий пароль'])->label(false); ?>
							</div>
						</div>
						<div class="form-group row showcase_row_area">
							<div class="col-md-3 showcase_text_area">
								<label for="inputEmail5">Новый пароль</label>
							</div>
							<div class="col-md-9 showcase_content_area">
								<?= $form->field($model, 'new_password')->passwordInput(['class' => "form-control", 'placeholder' => 'Новый пароль'])->label(false); ?>
							</div>
						</div>
						<div class="form-group row showcase_row_area">
							<div class="col-md-3 showcase_text_area">
								<label for="inputEmail5">Повторите пароль</label>
							</div>
							<div class="col-md-9 showcase_content_area">
								<?= $form->field($model, 'rec_password')->passwordInput(['class' => "form-control", 'placeholder' => 'Повторите пароль'])->label(false); ?>
							</div>
						</div>
               			 <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-sm btn-success']) ?>
					<?php Pjax::end() ?>
					<?php ActiveForm::end() ?>
				</div>
			</div>
		</div>

	</div>


</div>