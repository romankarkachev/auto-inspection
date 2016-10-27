<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsersNomenclature */

$this->title = 'Update Users Nomenclature: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Nomenclatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-nomenclature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
