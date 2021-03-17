<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\captcha\Captcha;
?>

<?php 
$syntax = <<< JS
	SyntaxHighlighter.all();
	$(".toolbar").hide();
JS;

$this->registerJs($syntax, yii\web\View::POS_READY);
?>

<div class="row">
	<div class="col-md-4 col-sm-12">

		<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin', 'enctype' => 'multipart/form-data']]) ?>
			<?php Pjax::begin(); ?>
				<div class="grid">
					<div class="grid-header">
						Загрузите плагин для анализа (<b class="text-warning top">BETA</b>)
					</div>
					<div class="grid-body">

                        <div class="row showcase_row_area mb-3">

                                <label>Загрузите файл</label>

                            <div class="col-md-12 showcase_content_area">
                                <div>
                                    <?= $form->field($model, 'item')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>

						<?= $form->field($model, 'captcha')->widget(Captcha::className())->label(false) ?>
    					<?= Html::submitButton("Загрузить плагин", ['class' => 'btn btn-sm btn-block mt-2 btn-success']) ?>
					</div>
				</div>
			<?php Pjax::end() ?>
		<?php ActiveForm::end() ?>

	</div>

	<div class="col-md-8 col-sm-12">
		<div class="grid">
			<?php if(Yii::$app->session->hasFlash('error')): ?>
				<div class="grid-header">
					<p class="text-warning">
						<?= Yii::$app->session->getFlash('error') ?>
					</p>
				</div>
			<?php endif ?>
			<?php if(Yii::$app->session->hasFlash('success')): ?>
				<div class="grid-header">
					<p class="text-success">
						<?= Yii::$app->session->getFlash('success') ?>
					</p>
				</div>
			<?php endif ?>
			</div>
			<div class="grid-body">
					<?php if($item != null): ?>
						<pre type="syntaxhighlighter" class="code-analysis brush: php">
							<?= Html::encode(@file_get_contents('analysis/'.$item)) ?>
						</pre>
					<?php else: ?>
						<h5 class="text-center text-muted">Загрузите плагин</h5>
					<?php endif; ?>
			</div>
		</div>
	</div>

</div>