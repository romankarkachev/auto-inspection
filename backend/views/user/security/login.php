<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \dektrium\user\models\LoginForm */

$this->title = 'Авторизация | '.Yii::$app->name;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="admin-form theme-info mw500" id="login">
    <div class="row table-layout">
        <?= Html::a(Html::img('/images/logo128.png', ['title' => 'Логотип системы '.Yii::$app->name, 'class' => 'center-block img-responsive', 'style' => 'max-width: 275px;']), ['/']) ?>

    </div>
    <div class="panel mt30 mb25">
        <?php $form = ActiveForm::begin([
            'id'                     => 'login-form',
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
        ]) ?>

            <div class="panel-body bg-light p25 pb15">
                <div class="section">
                    <?= $form->field($model, 'login', [
                        'labelOptions' => ['class' => 'field-label text-muted fs18 mb10'],
                        'inputTemplate' => '
                    <label for="login-form-login" class="field prepend-icon">
                        {input}
                        <label for="login-form-login" class="field-icon"><i class="fa fa-user"></i></label>
                    </label>',
                        'inputOptions' => [
                            'autofocus' => 'autofocus', 'class' => 'gui-input', 'tabindex' => '1'
                        ],
                    ])->textInput(['placeholder' => 'Введите имя пользователя']) ?>

                </div>

                <div class="section">
                    <?= $form->field($model, 'password', [
                        'labelOptions' => ['class' => 'field-label text-muted fs18 mb10'],
                        'inputTemplate' => '
                    <label for="login-form-password" class="field prepend-icon">
                        {input}
                        <label for="login-form-password" class="field-icon"><i class="fa fa-lock"></i></label>
                    </label>',
                        'inputOptions' => [
                            'class' => 'gui-input', 'tabindex' => '2'
                        ],
                    ])->passwordInput(['placeholder' => 'Введите пароль']) ?>

                </div>
            </div>
            <div class="panel-footer clearfix">
                <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn btn-primary btn-gradient mr10 pull-right', 'tabindex' => '3']) ?>

            </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
