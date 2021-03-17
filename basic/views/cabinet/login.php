<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin']]) ?>
<?php Pjax::begin(); ?>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'name')->textInput(['placeholder' => "Введите ваш E-mail", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Введите ваш пароль", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-inline">
      <div class="checkbox">
        <label><input type="checkbox" class="form-check-input">Запомнить меня <i class="input-frame"></i></label>
      </div>
    </div>
    <?= Html::submitButton("Авторизоваться", ['class' => 'btn btn-success btn-block']) ?>
<?php Pjax::end() ?>
<?php ActiveForm::end() ?>
<div class="signup-link"><p>Впервые на сайте?</p>
    <a href="<?= Url::to('/cabinet/register') ?>">Регистрация</a>
</div>
