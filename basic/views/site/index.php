<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
?>

<div class="row">

<div class="col-lg-6 col-md-6 col-sm-12">

	<a href="<?= Url::to('/cabinet/items/add') ?>"><button type="submit" class="btn btn-sm btn-block btn-success">Добавить новый товар</button></a>

	<div class="table-responsive mt-2">
		<table class="table table-hover table-sm">
			<tbody>
				<?php if($items != null): ?>
					<?php foreach($items as $item): ?>
						<tr class="grid">
							<td>
								<img class="img-sm" src="<?= Url::to("@web/favicon.ico"); ?>">
							</td>
							<td>
								<small class="text-black font-weight-medium"><?= Html::encode($item->name) ?></small> 
								<span class="text-gray">
									<?php if($item->verified == "false"): ?>
										<span class="status-indicator rounded-indicator small bg-danger"></span> Ожидает проверки
									<?php else: ?>
										<span class="status-indicator rounded-indicator small bg-success"></span> Прошёл проверку
									<?php endif; ?>
								</span>
							</td>
							<td>
								<small>Продано <b class="text-success">0</b> раз</small>
							</td>
							<td><a href="<?= Url::to("/cabinet/items/info/".$item->id) ?>" class="text-success">Посмотреть</a></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
						<td>
							<td><h5>Ваш список товаров пуст..</h5></td>
						</tr>
				<?php endif; ?>
			</tbody>
		</table>

            <strong class="text-center justify-content-center dataTables_paginate paging_simple_numbers pagination mt-5">
                <?= LinkPager::widget(['pagination' => $pages]); ?>
            </strong>

	</div>
</div>

	<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="grid table-responsive">
			<table class="table table-stretched">
				<thead>
					<tr>
						<th>Покупатель</th>
						<th>Товар</th>
						<th>Доход</th>
					</tr>
				</thead>
				<tbody>
				<?php if($historyTrade != null): ?>
					<?php foreach($historyTrade as $info): ?>
						<tr>
							<td>
								<small class="text-gray"><?= Html::encode($info->email) ?></small>
							</td>
							<td>
								<small class="text-gray"><?= Html::encode($info->name) ?></small>
							</td>
							<td>
								<div class="text-success"><b>+<?= Html::encode($info->price) ?> <i class="mdi mdi-database-plus"></i></b></div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
						<td>
							<td><h5>История продаж пуста..</h5></td>
						</tr>
				<?php endif; ?>		
				</tbody>
			</table>
		</div>
	</div>

</div>