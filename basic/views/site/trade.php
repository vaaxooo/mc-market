<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use app\models\Items;
?>

<div class="row">
	<div class="col-md-6 col-sm-12">
		<a href="<?= Url::to('/mcpe/plugins') ?>" class="text-dark">
			<div class="grid">
				<div class="grid-body">					
					<div class="d-flex align-items-end mt-2"><h3 class="text-uppercase">Плагины</h3><p class="ml-1 font-weight-bold text-uppercase">Minecraft PE</p></div>
					<div class="d-flex mt-2">
						<div class="wrapper d-flex pr-4">
							<small class="text-success font-weight-medium mr-2">Плагинов в разделе</small> 
							<small class="text-gray"><?= Html::encode(count(Items::find()->where(['game' => 'mcpe', 'category' => 'plugins'])->all())) ?></small>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="#" class="text-dark"  data-toggle="modal" data-target="#error-modal">
			<div class="grid">
				<div class="grid-body">
					<div class="d-flex align-items-end mt-2"><h3 class="text-uppercase">Плагины</h3><p class="ml-1 font-weight-bold text-uppercase">Minecraft PC</p></div>
					<div class="d-flex mt-2">
						<div class="wrapper d-flex pr-4">
							<small class="text-success font-weight-medium mr-2">Плагинов в разделе</small> 
							<small class="text-gray">0</small>
						</div>
					</div>
					<canvas class="chartjs-chart chartjs-render-monitor" height="14" id="stat-line_2" width="100" style="display: block; width: 96px; height: 14px;"></canvas>
				</div>
			</div>
		</a>
	</div>

	<div class="col-md-6 col-sm-12">
		<a href="<?= Url::to('/mcpe/maps') ?>" class="text-dark" >
			<div class="grid">
				<div class="grid-body">
					<div class="d-flex align-items-end mt-2"><h3 class="text-uppercase">Карты</h3><p class="ml-1 font-weight-bold text-uppercase">Minecraft PE</p></div>
					<div class="d-flex mt-2">
						<div class="wrapper d-flex pr-4">
							<small class="text-success font-weight-medium mr-2">Карт в разделе</small> 
							<small class="text-gray"><?= Html::encode(count(Items::find()->where(['game' => 'mcpe', 'category' => 'maps'])->all())) ?></small>
						</div>
					</div>
				</div>
			</div>
		</a>
		<a href="#" class="text-dark"  data-toggle="modal" data-target="#error-modal">
			<div class="grid">
				<div class="grid-body">
					<div class="d-flex align-items-end mt-2"><h3 class="text-uppercase">Карты</h3><p class="ml-1 font-weight-bold text-uppercase">Minecraft PC</p></div>
					<div class="d-flex mt-2">
						<div class="wrapper d-flex pr-4">
							<small class="text-success font-weight-medium mr-2">Карт в разделе</small> 
							<small class="text-gray">0</small>
						</div>
					</div>
					<canvas class="chartjs-chart chartjs-render-monitor" height="14" id="stat-line_3" width="96" style="display: block; width: 96px; height: 14px;"></canvas>
				</div>
			</div>
		</a>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="error-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column justify-content-center align-items-center"><i class="mdi mdi-alert-octagram mdi-6x text-danger"></i>
                    <h4 class="text-black font-weight-medium mb-4">Ошибка!</h4>
                    <p class="text-center">Данный раздел временно недоступен!</p>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>