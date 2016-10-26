<?php

/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = 'Новая страна | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => ['/countries']];
$this->params['breadcrumbs'][] = 'Новая *';
?>
<div class="countries-create">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
