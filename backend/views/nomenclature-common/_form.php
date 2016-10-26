<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use common\models\NomenclatureCategories;
use common\models\NomenclatureTypes;
use common\models\Units;

/* @var $this yii\web\View */
/* @var $model common\models\Nomenclature */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="nomenclature-form">
    <div class="admin-form theme-info">
        <div class="panel heading-border panel-info">
            <div class="panel-body pt40 pb5 bg-light">
                <?php $form = ActiveForm::begin(['fieldConfig' => [
                    'labelOptions' => ['class' => 'field-label'],
                ]]); ?>

                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введите наименование']) ?>

                </div>
                <div class="form-group">
                    <?= $form->field($model, 'name_full')->textarea(['rows' => 3]) ?>

                </div>
                <div class="row section">
                    <div class="col-md-3">
                        <?= $form->field($model, 'category_id')->widget(Select2::className(), [
                            'data' => NomenclatureCategories::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'type_id')->widget(Select2::className(), [
                            'data' => NomenclatureTypes::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'unit_id')->widget(Select2::className(), [
                            'data' => Units::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Номенклатура', ['/nomenclature-common'], ['class' => 'btn btn-default btn-gradient btn-lg', 'title' => 'Вернуться в список. Изменения не будут сохранены']) ?>

                <?php if ($model->isNewRecord): ?>
                    <?= Html::submitButton('<i class="fa fa-plus-circle" aria-hidden="true"></i> Создать', ['class' => 'btn btn-success btn-gradient btn-lg']) ?>
                <?php else: ?>
                    <?= Html::submitButton('<i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить', ['class' => 'btn btn-primary btn-gradient btn-lg']) ?>
                <?php endif; ?>

            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
