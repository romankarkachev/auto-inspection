<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Страны | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => ['/countries']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="countries-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
