<?php

use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Vendors */

$this->title = $model->name.' '.HtmlPurifier::process('&mdash;').' Производители | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['/countries']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="vendors-update">
    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
