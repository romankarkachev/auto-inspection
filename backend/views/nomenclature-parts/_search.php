<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsersNomenclatureSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $searchApplied bool */
?>

<div class="users-nomenclature-search">
    <?php $form = ActiveForm::begin([
        'action' => ['/nomenclature-parts'],
        'method' => 'get',
        'options' => ['id' => 'frm-search', 'class' => ($searchApplied ? 'collapse in' : 'collapse')],
    ]); ?>

    <div class="panel panel-info panel-border top">
        <div class="panel-heading">
            <span class="panel-title">Отбор</span>
            <div class="widget-menu pull-right">
                <code class="mr10 p3 ph5">поиск по Вашей номенклатуре</code>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'searchNomenclatureName') ?>

        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-filter"></i> Выполнить', ['class' => 'btn btn-info btn-gradient']) ?>

                <?= Html::a('Сброс', ['/nomenclature-parts'], ['class' => 'btn btn-default btn-gradient']) ?>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
