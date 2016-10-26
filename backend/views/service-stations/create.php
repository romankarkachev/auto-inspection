<?php

/* @var $this yii\web\View */
/* @var $model common\models\ServiceStations */

$this->title = 'Новая станция техобслуживания | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Станции техобслуживания', 'url' => ['/service-stations']];
$this->params['breadcrumbs'][] = 'Новая *';
?>
<div class="service-stations-create">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
