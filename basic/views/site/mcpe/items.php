<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
?>

<div class="table-responsive mt-2">
	<table class="table table-hover table-sm">
		<tbody>
			<?php foreach($items as $item): ?>
				<tr class="grid">
					<td>
						<span class="icon-fg" style="background-image: url('<?= Url::to('@web/favicon.ico') ?>');"></span>
					</td>
					<td>
						<small class="text-black font-weight-medium"><?= Html::encode($item->name) ?></small> 
						<span class="text-gray">
							<span class="status-indicator rounded-indicator small bg-success"></span> <?= Html::encode($item->small_description) ?>
						</span>
					</td>
					<td>
						<small>Версия: <b class="text-success"><?= Html::encode($item->version) ?></b></small>
					</td>
					<td>
						<small>Стоимость: <b class="text-success"><?php if($item->price != 0): echo Html::encode($item->price).' <i class="mdi mdi-database-plus"></i>'; else: echo "Бесплатно"; endif; ?></b></small>
					</td>
					<td><a href="<?= Url::to('/mcpe/plugins/view/'.$item->id) ?>" class="text-success">Посмотреть</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

            <strong class="text-center justify-content-center dataTables_paginate paging_simple_numbers pagination mt-5">
                <?= LinkPager::widget(['pagination' => $pages]); ?>
            </strong>

</div>