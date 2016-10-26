<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\NomenclatureCategories */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Категории номенклатуры | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории номенклатуры', 'url' => ['/nomenclature-categories']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="nomenclature-categories-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
