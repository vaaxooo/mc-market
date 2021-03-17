<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
?>

<div class="col-md-10 col-sm-12">

		<?php if(Yii::$app->session->hasFlash('error')): ?>
			<div class="alert alert-warning">
				<?= Yii::$app->session->getFlash('error') ?>
			</div>
		<?php endif ?>

	<div class="grid">
		<div class="grid-body">
			<div class="row">

				<div class="col-md-5 col-sm-12">
					<ul>
						<li><b>Название:</b> <?= Html::encode($item->name) ?></li>
						<li><b>Версия:</b> <?= Html::encode($item->version) ?></li>
						<li>
							<b>Стоимость товара:</b> 
							<b class="text-success">
								<?php if($item->price == 0): ?>Бесплатно<?php else: ?><?= Html::encode($item->price) ?> <i class="mdi mdi-database-plus"></i><?php endif; ?>
							</b>
						</li>
						<li><b>Игра:</b> <?php if($item->game == "mcpe"): echo "Minecraft PE"; else: echo "Minecraft PC"; endif; ?></li>
						<li><b>Дата добавления:</b> <?= Html::encode($item->date) ?></li>
						<li><b>Теги:</b> 
							<?php 
								$tags = explode(', ', $item->tags); 
								foreach($tags as $tag):
									echo '<span class="badge badge-pill badge-light">'.$tag.'</span> ';
								endforeach;
							?>

						</li>
					</ul>
				</div>

				<div class="col-md-5 col-sm-12">
					<ul>
						<li><b>Краткое описание:</b> <?= Html::encode($item->small_description) ?></li>
						<li><b>Описание:</b> <small><?= Html::encode($item->description) ?></small></li>
						<?php if($item->price != 0): ?>
							<li><b>Продаж: <span class="badge badge-pill badge-light"><?= Html::encode($historyCount) ?></span></b></li>
						<?php endif; ?>
						<?php if($item->price != 0): ?>
							<?php if($item->account != Yii::$app->session['email']): ?>
								<?php if($history == 0): ?>
									<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
										<?php Pjax::begin(); ?>
	      									<?= $form->field($model, 'id')->hiddenInput(['value' => $item->id, 'class' => "form-control"])->label(false); ?>
											<li class="mt-2">
												<?= Html::submitButton("Перейти к оплате", ['class' => 'btn btn-sm btn-block btn-success']) ?>
											</li>
										<?php Pjax::end() ?>
									<?php ActiveForm::end() ?>
								<?php else: ?>
								<li class="mt-2"><a href="<?= Url::to('@'.$item->download_link) ?>" download><button type="submit" class="btn btn-sm btn-block btn-success">Скачать</button></a></li>
								<?php endif; ?>
							<?php else: ?>
								<li class="mt-2"><a href="<?= Url::to('@'.$item->download_link) ?>" download><button type="submit" class="btn btn-sm btn-block btn-success">Скачать</button></a></li>
							<?php endif; ?>
						<?php else: ?>
							<li class="mt-2"><a href="<?= Url::to('@'.$item->download_link) ?>" download><button type="submit" class="btn btn-sm btn-block btn-success">Скачать</button></a></li>
						<?php endif; ?>
					</ul>
				</div>

				<hr>

				<div class="col-md-12 col-sm-12 mt-5">
					<?= Html::img(Url::to("@".$item->image1), ['class' => 'item-images']) ?>
					<?= Html::img(Url::to("@".$item->image2), ['class' => 'item-images']) ?>
					<?php if($item->image3 != null): ?>
						<?= Html::img(Url::to("@".$item->image3), ['class' => 'item-images']) ?>
					<?php endif; ?>
					<?php if($item->image4 != null): ?>
						<?= Html::img(Url::to("@".$item->image4), ['class' => 'item-images']) ?>
					<?php endif; ?>
					<?php if($item->image5 != null): ?>
						<?= Html::img(Url::to("@".$item->image5), ['class' => 'item-images']) ?>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
</div>