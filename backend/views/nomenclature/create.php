<?php

/* @var $this yii\web\View */
/* @var $model common\models\UsersNomenclature */
/* @var $nomenclature common\models\CreateUserNomenclatureForm */
/* @var $return string */

$this->title = 'Новая номенклатура | '.Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Номенклатура', 'url' => ['/nomenclature'.($return == null ? '' : '-' . $return)]];
$this->params['breadcrumbs'][] = 'Новая *';
?>
<div class="nomenclature-parts-create">
    <?= $this->render('_creation_form', [
        'model' => $model,
        'nomenclature' => $nomenclature,
    ]) ?>

</div>
