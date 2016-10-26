<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Suppliers */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Поставщики запчастей | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Поставщики запчастей', 'url' => ['/suppliers']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="suppliers-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
