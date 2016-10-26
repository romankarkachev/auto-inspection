<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\ServiceStations */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Станции техобслуживания | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Станции техобслуживания', 'url' => ['/service-stations']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="service-stations-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
