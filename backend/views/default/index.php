<?php

/* @var $this yii\web\View */

$this->title = 'Добро пожаловать!';

$this->params['breadcrumbs'][] = [
    'label' => 'Рабочий стол',
    'url' => '/',
    'template' => "                        <li class=\"crumb-active\">{link}</li>\n",
];
?>
<div class="welcome">
    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        <p class="lead">Вас приветствует система учета техобслуживания автомобилей <?= Yii::$app->name ?>.</p>
    </div>
</div>
