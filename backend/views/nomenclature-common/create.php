<?php

/* @var $this yii\web\View */
/* @var $model common\models\Nomenclature */

$this->title = 'Новая номенклатура | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Номенклатура', 'url' => ['/nomenclature-common']];
$this->params['breadcrumbs'][] = 'Новая *';
?>
<div class="nomenclature-create">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
