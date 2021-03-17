<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
?>

<div class="col-md-10 col-sm-12">
	<div class="grid">
		<div class="grid-body">
			<div class="row">

				<div class="col-md-5 col-sm-12">
					<ul>
						<li><b>Название:</b> <?= Html::encode($item->name) ?></li>
						<li><b>Версия:</b> <?= Html::encode($item->version) ?></li>
						<li><b>Стоимость товара:</b> <b class="text-success"><?= Html::encode($item->price) ?>  <i class="mdi mdi-database-plus"></i></b></li>
						<li><b>Игра:</b> <?php if($item->game == "mcpe"): echo "Minecraft PE"; else: echo "Minecraft PC"; endif; ?></li>
						<li><b>Категория:</b> <?php if($item->category == "plugins"): echo "Плагины"; else: echo "Карты"; endif; ?></li>
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
						<li><b>Статус:</b> <?php if($item->verified == "false"): echo "<b class='text-warning'>Ожидает проверки</b>"; else: echo "<b class='text-success'>Прошёл проверку</b>"; endif; ?></li>
						<?php if(isset(Yii::$app->session['admin'])): ?>
							<div class="row mt-2">
								<li><a href="<?= Url::to("/admin/items/activate/".$item->id) ?>"><button type="submit" class="btn btn-success btn-xs">Активировать</button></a></li>
								<li><a href="<?= Url::to("/admin/items/remove/".$item->id) ?>"><button type="submit" class="btn btn-warning btn-xs ml-2">Заблокировать</button></a></li>
							</div>
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