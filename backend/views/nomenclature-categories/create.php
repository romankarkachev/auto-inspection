<?php

/* @var $this yii\web\View */
/* @var $model common\models\NomenclatureCategories */

$this->title = 'Новая категория номенклатуры | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории номенклатуры', 'url' => ['/nomenclature-categories']];
$this->params['breadcrumbs'][] = 'Новая *';

$this->blocks['content-header'] = '<a href="#manual" class="m-r-sm" data-toggle="collapse" aria-controls="manual" aria-expanded="false" title="Показать инструкцию"><i class="fa fa-question-circle"></i></a>';
?>
<div class="nomenclature-categories-create">
    <div id="manual" class="collapse text-justify">
        <div class="panel panel-info">
            <div class="panel-heading">
                <span class="panel-title">Инструкция</span>
            </div>
            <div class="panel-body">
                <p>Возможно, здесь будет инструкция.</p>
            </div>
        </div>
    </div>
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
