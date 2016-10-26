<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

backend\assets\AppAsset::register($this);

rmrevin\yii\fontawesome\AssetBundle::register($this);

romankarkachev\web\AbsoluteAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']) ?>
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => '/favicon.ico']) ?>
    <?= $this->registerMetaTag(['name' => 'author', 'content' => 'Роман Каркачев, Россия | skype:romankarkachev | mailto:post@romankarkachev.ru | +7 928 12 12 863']); ?>
    <?php $this->head() ?>
</head>
<body class="external-page external-alt sb-l-c sb-r-c">
<?php $this->beginBody() ?>
<div id="main" class="animated fadeIn">
    <section id="content_wrapper">
        <section id="content">
            <?= $content ?>

        </section>
    </section>
</div>
<?php $this->registerJs(<<<JS
    Core.init();
JS
, \yii\web\View::POS_READY); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
