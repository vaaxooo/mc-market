<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
?>

<div class="col-lg-12">

    <div class="grid">
        <p class="grid-header">Обязательно к прочтению!</p>
        <div class="grid-body">
            <div class="item-wrapper">
                <p>При добавлении товара - указывайте максимально точно данные! После отправки товара на модерацию - его изменить будет нельзя!</p>
                <p>Указывайте только то, что описывает ваш товар! Иначе есть шанс, что ваш товар не пройдёт проверку!</p>
                <p>Вы можете загрузить до 5 скриншотов вашего товара! </p>
                <hr>
                <p><i class="mdi mdi-check text-success"></i> После одобрения модерацией, ваш товар попадает в список новых и проверенных товаров, что увеличивает ваш шанс продажи!</p>
            </div>
        </div>
    </div>


<?php $form = ActiveForm::begin(['options' => ['class' => 'js-validation-signin', 'enctype' => 'multipart/form-data']]) ?>
<?php Pjax::begin(); ?>
    <div class="grid">
        <p class="grid-header">Новый товар</p>
        <div class="grid-body">
            <div class="item-wrapper">
                <div class="row mb-3">
                    <div class="col-md-8 mx-auto">
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Название товара</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'name')->textInput(['placeholder' => "Название товара", 'class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Укажите версию</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'version')->textInput(['placeholder' => "Введите версию", 'class' => "form-control"])->label(false); ?>
                            </div>
                            <small class="text-warning">(Например: 1.1 или 1.1-1.10)</small>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType12">Краткое описание..</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'small_description')->textInput(['placeholder' => "Кратко опишите товар", 'class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Введите теги</label>
                                <small class="text-muted">(Поможет при поиске плагина)</small>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'tags')->textInput(['placeholder' => "Введите теги", 'class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType13">Описание товара</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'description')->textarea(['placeholder' => "Опишите как можно подробнее товар", 'class' => "form-control", 'cols' => 12, 'rows' => 5])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Стоимость товара</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'price')->textInput(['placeholder' => "Укажите стоимость плагина (в рублях)", 'class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Выберите игру</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'game')->dropdownList(['mcpe' => 'Minecraft PE', 'mcpc' => 'Minecraft PC'], ['class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="form-group row showcase_row_area">
                            <div class="col-md-3 showcase_text_area">
                                <label for="inputType1">Выберите раздел</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <?= $form->field($model, 'category')->dropdownList(['plugins' => 'Плагины', 'maps' => 'Карты'], ['class' => "form-control"])->label(false); ?>
                            </div>
                        </div>
                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Изображение 1</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div>
                                    <?= $form->field($model, 'img1')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Изображение 2</label>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div class="custom-file">
                                    <?= $form->field($model, 'img2')->fileInput()->label(false) ?>
                                </div>
                            </div>
                                    
                        </div>

                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Изображение 3</label>
                            <small class="text-muted">(необязательно)</small>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div class="custom-file">
                                    <?= $form->field($model, 'img3')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Изображение 4</label>
                                <small class="text-muted">(необязательно)</small>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div class="custom-file">
                                    <?= $form->field($model, 'img4')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Изображение 5</label>
                                <small class="text-muted">(необязательно)</small>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div class="custom-file">
                                    <?= $form->field($model, 'img5')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row showcase_row_area mb-3">
                            <div class="col-md-3 showcase_text_area">
                                <label>Загрузите ваш товар</label>
                                <small class="text-warning">(обьязательно)</small>
                            </div>
                            <div class="col-md-9 showcase_content_area">
                                <div class="custom-file">
                                    <?= $form->field($model, 'item')->fileInput()->label(false) ?>
                                </div>
                            </div>
                        </div>
                         <?= Html::submitButton("Отправить товар на проверку", ['class' => 'btn btn-sm btn-block btn-success']) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php Pjax::end() ?>
<?php ActiveForm::end() ?>

</div>