<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NomenclatureTypes */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="nomenclature-types-form">
    <div class="admin-form theme-info">
        <div class="panel heading-border panel-info">
            <div class="panel-body pt40 pb5 bg-light">
                <?php $form = ActiveForm::begin(['fieldConfig' => [
                    'labelOptions' => ['class' => 'field-label'],
                ]]); ?>

                <div class="row section">
                    <div class="col-md-3">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введите наименование']) ?>

                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'name_plural_nominative_case')->textInput(['maxlength' => true, 'placeholder' => '(кто? что?)']) ?>

                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'name_plural_genitive_case')->textInput(['maxlength' => true, 'placeholder' => '(кого? чего?)']) ?>

                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'name_plural_dative_case')->textInput(['maxlength' => true, 'placeholder' => '(кому? чему?)']) ?>

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Типы номенклатуры', ['/nomenclature-types'], ['class' => 'btn btn-default btn-gradient btn-lg', 'title' => 'Вернуться в список. Изменения не будут сохранены']) ?>

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
