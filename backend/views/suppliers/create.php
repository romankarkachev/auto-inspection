<?php

/* @var $this yii\web\View */
/* @var $model common\models\Suppliers */

$this->title = 'Новый поставщик | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Поставщики запчастей', 'url' => ['/suppliers']];
$this->params['breadcrumbs'][] = 'Новый *';
?>
<div class="suppliers-create">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
