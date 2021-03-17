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
      <?= $form->field($model, 'firstname')->textInput(['placeholder' => "Введите ваше Имя", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'lastname')->textInput(['placeholder' => "Введите вашу Фамилию", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'email')->textInput(['placeholder' => "Введите ваш E-mail", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Придумайте пароль", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-group input-rounded">
      <?= $form->field($model, 'passwordTwo')->passwordInput(['placeholder' => "Повторите пароль", 'class' => "form-control"])->label(false); ?>
    </div>
    <div class="form-inline">
      <div class="checkbox">
        <label>Регистрируясь вы принимаете <a href="" class="text-success">Условия использования</a>!</label>
      </div>
    </div>
    <?= Html::submitButton("Зарегистрироваться", ['class' => 'btn btn-success btn-block']) ?>
<?php Pjax::end() ?>
<?php ActiveForm::end() ?>
<div class="signup-link"><p>Уже имеете аккаунт?</p>
    <a href="<?= Url::to('/cabinet/login') ?>">Вход в личный кабинет</a>
</div>

