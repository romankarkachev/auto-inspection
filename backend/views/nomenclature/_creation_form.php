<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use common\models\NomenclatureCategories;
use common\models\NomenclatureTypes;
use common\models\Units;

/* @var $this yii\web\View */
/* @var $model common\models\UsersNomenclature */
/* @var $nomenclature common\models\CreateUserNomenclatureForm */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="users-nomenclature-form">
    <div class="admin-form theme-success">
        <div class="panel heading-border panel-success">
            <div class="panel-body bg-light">
                <div class="section-divider mb40">
                    <span>Добавить существующую номенклатуру</span>
                </div>
                <?php $form = ActiveForm::begin([
                    'action' => ['/nomenclature/new', 'action' => 'add'],
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'field-label'],
                    ]
                ]); ?>

                <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'nomenclature_id')->widget(Select2::className(), [
                            'initValueText' => $model->getNomenclatureName(),
                            'language' => 'ru',
                            'options' => ['placeholder' => 'Введите наименование'],
                            'pluginOptions' => [
                                'minimumInputLength' => 1,
                                'language' => 'ru',
                                'ajax' => [
                                    'url' => Url::to(['nomenclature/list-nf']),
                                    'delay' => 250,
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(result) { return result.text; }'),
                                'templateSelection' => new JsExpression('function (result) {
                            // при загрузке страницы тоже выполняется, но отсутствуют дополнительные реквизиты,
                            // например name_full
                            if (result.name_full == undefined) return result.text;
                            
                            if (result.ncat != "") $("#nomenclature-category").text(result.ncat);
                            if (result.ntype != "") $("#nomenclature-type").text(result.ntype);
                            if (result.nunit != "") $("#nomenclature-unit").text(result.nunit);
                            
                            return result.text;
                                }'),
                            ],
                        ]); ?>

                    </div>
                    <div class="col-md-4">
                        <div class="inline-tp mv20">
                            <div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;">
                                <div class="ui-timepicker-div">
                                    <dl style="border: none;">
                                        <dt class="ui_tpicker_time_label">Категория</dt>
                                        <dd id="nomenclature-category" class="ui_tpicker_time">-</dd>
                                        <dt class="ui_tpicker_time_label">Тип</dt>
                                        <dd id="nomenclature-type" class="ui_tpicker_time">-</dd>
                                        <dt class="ui_tpicker_time_label">Единица измерения</dt>
                                        <dd id="nomenclature-unit" class="ui_tpicker_time">-</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'notes', [
                            'template' => '{label}<label class="field prepend-icon">
                        {input}
                        <label for="comment" class="field-icon">
                            <i class="fa fa-comments"></i>
                        </label>
                        <span class="input-footer text-justify">
                              <strong>Необязательно:</strong> В это поле можно ввести собственные заметки к номенклатуре, которая добавляется.</span>
                    </label>'
                        ])->textarea(['class' => 'gui-textarea',]) ?>

                    </div>
                </div>
                <div class="form-group text-right">
                    <?= Html::submitButton('<i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить', ['class' => 'btn btn-info btn-gradient btn-lg']) ?>

                </div>

                <?php ActiveForm::end(); ?>

                <div class="section-divider mt40 mb25">
                    <span>Создание новой номенклатуры</span>
                </div>
                <?php $form = ActiveForm::begin([
                    'action' => ['/nomenclature/new', 'action' => 'create'],
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'field-label'],
                    ]
                ]); ?>

                <?= $form->field($nomenclature, 'user_id')->hiddenInput()->label(false) ?>

                <div class="row section">
                    <div class="col-md-3">
                        <?= $form->field($nomenclature, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введите наименование']) ?>

                    </div>

                    <div class="col-md-3">
                        <?= $form->field($nomenclature, 'category_id')->widget(Select2::className(), [
                            'data' => NomenclatureCategories::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                    <div class="col-md-2">
                        <?= $form->field($nomenclature, 'type_id')->widget(Select2::className(), [
                            'data' => NomenclatureTypes::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                    <div class="col-md-2">
                        <?= $form->field($nomenclature, 'unit_id')->widget(Select2::className(), [
                            'data' => Units::arrayMap(),
                            'options' => ['placeholder' => '- выберите -'],
                        ]) ?>

                    </div>
                    <div class="col-md-2">
                        <div class="form-group field-createusernomenclatureform-strong">
                            <label class="field-label" for="createusernomenclatureform-strong">Запчасть усилена</label>
                            <label class="option option-primary">
                                <input type="checkbox" name="checked" value="checked" checked="">
                                <span class="checkbox"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?= $form->field($nomenclature, 'name_full', [
                        'template' => '{label}<label class="field prepend-icon">
                        {input}
                        <label for="comment" class="field-icon">
                            <i class="fa fa-align-left"></i>
                        </label>
                        <span class="input-footer text-justify">
                              <strong>Внимание!</strong> Это поля обязательно для заполнения.</span>
                    </label>'
                    ])->textarea(['class' => 'gui-textarea', 'placeholder' => 'Введите полное наименование']) ?>

                </div>
                <div class="form-group">
                    <?= $form->field($nomenclature, 'notes', [
                        'template' => '{label}<label class="field prepend-icon">
                        {input}
                        <label for="comment" class="field-icon">
                            <i class="fa fa-comments"></i>
                        </label>
                        <span class="input-footer text-justify">
                              <strong>Необязательно:</strong> В это поле можно ввести собственные заметки к номенклатуре, которая добавляется.</span>
                    </label>'
                    ])->textarea(['class' => 'gui-textarea', 'placeholder' => 'Введите примечание']) ?>

                </div>

                <div class="form-group text-right">
                    <?= Html::submitButton('<i class="fa fa-plus-circle" aria-hidden="true"></i> Создать и добавить', ['class' => 'btn btn-success btn-gradient btn-lg']) ?>

                </div>

                <?php ActiveForm::end(); ?>

                <div class="row">
                    <div class="col-md-4">
            </div>
        </div>

    </div>
</div>
<?php
$this->registerJs(<<<JS
// Функция-обработчик изменения значения в поле Наименование.
//
function NameOnChange() {
    name_full = $("#createusernomenclatureform-name_full").val();
    if (name_full == "") $("#createusernomenclatureform-name_full").val($(this).val());
    
    return false;
}; // NameOnChange()

$(document).on("change", "#createusernomenclatureform-name", NameOnChange);
JS
, \yii\web\View::POS_READY);
?>

