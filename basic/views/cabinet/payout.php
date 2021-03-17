<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

function PayoutStatus($payout){
	if($payout == 'unpaid'){
		echo '<b class="text-warning">Ожидает выплаты</b>';
	}else{
		echo '<b class="text-success">Выплачено</b>';
	}
}
?>
<div class="row">
	<div class="col-md-4 col-sm-12">

		<?php if(Yii::$app->session->hasFlash('error')): ?>
			<div class="alert alert-warning">
				<?= Yii::$app->session->getFlash('error') ?>
			</div>
		<?php endif ?>


		<div class="grid">
			<p class="grid-header">Вывод средств</p>
			<div class="grid-body">
				<div class="item-wrapper">
					<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
					<?php Pjax::begin(); ?>
						<div class="form-group">
							<div class="col-md-12">
								<?= $form->field($modelPayout, 'payout_type')->dropdownList(['Qiwi' => 'Qiwi', 'Yandex Money' => 'Yandex Money', 'Visa/MasterCard' => 'Visa/MasterCard', 'Phone' => 'Phone'], ['class' => "form-control"])->label('Способ выплаты'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<?= $form->field($modelPayout, 'wallet')->textInput(['class' => "form-control", 'placeholder' => 'Номер кошелька'])->label('Номер кошелька'); ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<?= $form->field($modelPayout, 'sum')->textInput(['class' => "form-control", 'placeholder' => 'Укажите сумму вывода'])->label('Сумма вывода'); ?>
							</div>
						</div>
               			 <?= Html::submitButton('Вывести средства', ['class' => 'btn btn-sm btn-block btn-success']) ?>
					<?php Pjax::end() ?>
					<?php ActiveForm::end() ?>
				</div>
			</div>
		</div>

	</div>


	<div class="col-md-8 col-sm-12">

		<div class="grid table-responsive">
			<table class="table table-stretched">
				<thead>
					<tr>
						<th>Способ выплаты</th>
						<th>Номер кошелька</th>
						<th>Статус</th>
						<th>Сумма</th>
						<th>Дата</th>
					</tr>
				</thead>
				<tbody>
					<?php if($payouts != null): ?>
						<?php foreach($payouts as $payout): ?>
							<tr>
								<td>
									<small class="text-muted"><?= Html::encode($payout->payout_type) ?></small>
								</td>
								<td>
									<small class="text-muted"><?= Html::encode($payout->wallet) ?></small>
								</td>
								<td>
									<small class="text-success"><?php PayoutStatus($payout->status); ?></small>
								</td>
								<td>
									<div class="text-warning"><b>-<?= Html::encode($payout->sum) ?> <i class="mdi mdi-database-minus"></i></b></div>
								</td>
								<td>
									<small class="text-muted"><?= Html::encode($payout->date) ?></small>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<td>
								<td><h5>История вывода средств пуста..</h5></td>
							</tr>
						<?php endif; ?>
				</tbody>
			</table>
		</div>


	</div>


</div>