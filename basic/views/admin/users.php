<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\widgets\LinkPager;
?>
<div class="card card-shadow">
    <div class="card-body">
        <div class="table-responsive">
 

                    <table id="results" class="table dataTable no-footer" role="grid" aria-describedby="results_info">
                        <thead>
                            <tr role="row">
                                <th style="width: 91px;">E-mail</th>
                                <th style="width: 210px;">Статус</th>
                                <th style="width: 210px;">Тип</th>
                                <th style="width: 210px;">Баланс</th>
                                <th style="width: 144px;">Дата регистрации</th>

                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach($usersList as $userData): ?>
                            <tr role="row" class="odd">
                                <td><?= Html::encode($userData->email) ?></td>
                                <td><span><?= Html::encode($userData->type) ?></span></td>
                                <td><?php if($userData->admin == "true"): ?><b class="text-warning">Администратор</b><?php else: ?><b class="text-dark">Пользователь</b><?php endif; ?></td>
                                <td><?= Html::encode($userData->balance) ?> <i class="mdi mdi-database-plus"></i></td>
                                <td><span data-toggle="tooltip" title=""><?= Html::encode($userData->date) ?></span></td>
                                <td>
                                    <?php if($userData->type == 'unbanned'): ?>
                                        <a href="<?= Url::to('/admin/users/ban/'.$userData->id) ?>" class="text-warning"><i class="mdi mdi-close-circle text-warning"></i> Заблокировать</a>
                                    <?php else: ?>
                                        <a href="<?= Url::to('/admin/users/ban/'.$userData->id) ?>" class="text-success"><i class="mdi mdi-check text-success"></i> Разблокировать</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    
                    </table>
           
        </div>

                    <strong class="text-center justify-content-center dataTables_paginate paging_simple_numbers pagination">
                        <?= LinkPager::widget(['pagination' => $pages]); ?>
                    </strong>
        
    </div>
</div>