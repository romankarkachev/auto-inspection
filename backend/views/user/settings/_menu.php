<?php

use yii\helpers\Html;
use yii\widgets\Menu;

/** @var dektrium\user\models\User $user */

$user = Yii::$app->user->identity;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= $user->username ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Profile'), 'url' => ['/profile']],
                ['label' => Yii::t('user', 'Account'), 'url' => ['/account']],
            ],
        ]) ?>
    </div>
</div>
