<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Nomenclature */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Номенклатура | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Номенклатура', 'url' => ['/nomenclature-common']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="nomenclature-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
