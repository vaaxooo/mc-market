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
			<p class="grid-header">Пополнение баланса</p>
			<div class="grid-body">
				<div class="item-wrapper">
					<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
					<?php Pjax::begin(); ?>
						<div class="form-group">
							<div class="col-md-12">
								<?= $form->field($modelPayment, 'amount')->textInput(['class' => "form-control", 'placeholder' => 'Укажите сумму пополнения'])->label('Сумма пополнения'); ?>
							</div>
						</div>
               			 <?= Html::submitButton('Перейти к оплате', ['class' => 'btn btn-sm btn-block btn-success']) ?>
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
						<th>Статус</th>
						<th>Сумма</th>
						<th>Дата</th>
					</tr>
				</thead>
				<tbody>
					<?php if($invoice != null): ?>
						<?php foreach($invoices as $invoice): ?>
							<tr>
								<td>
									<small><?php PayoutStatus($invoice->status); ?></small>
								</td>
								<td>
									<div class="text-success"><b>+<?= Html::encode($invoice->amount) ?> <i class="mdi mdi-database-plus"></i></b></div>
								</td>
								<td>
									<small class="text-muted"><?= Html::encode($invoice->date) ?></small>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<td>
								<td><h5>История пополнения баланса пуста..</h5></td>
							</tr>
						<?php endif; ?>
				</tbody>
			</table>
		</div>


	</div>


</div>