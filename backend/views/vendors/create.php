<?php

/* @var $this yii\web\View */
/* @var $model common\models\Vendors */

$this->title = 'Новый производитель | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['/vendors']];
$this->params['breadcrumbs'][] = 'Новый *';
?>
<div class="vendors-create">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
