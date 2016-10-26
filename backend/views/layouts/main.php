<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

backend\assets\AppAsset::register($this);

rmrevin\yii\fontawesome\AssetBundle::register($this);

romankarkachev\web\AbsoluteAdminAsset::register($this);

// представление имени пользователя: если указано имя, то оно (profile->name), а если нет - то имя пользователя (username)
$username = Yii::$app->user->identity->profile->name != '' ? Yii::$app->user->identity->profile->name : Yii::$app->user->identity->username;

// аватар
$profile_images = Yii::getAlias('@uploads-profiles').'/';
$avatar = $profile_images.'no-avatar.png';
if (Yii::$app->user->identity->profile->avatar_tfn != null && Yii::$app->user->identity->profile->avatar_tfn != '')
    if (file_exists(Yii::$app->user->identity->profile->avatar_tffp))
        $avatar = $profile_images.Yii::$app->user->identity->profile->avatar_tfn;
unset($profile_images);

// сайдбар (меню слева)
if (Yii::$app->user->can('root'))
    $items = [
        ['label' => 'Контрагенты', 'class' => 'text-primary', 'icon' => 'fa fa-male pull-right', 'url' => ['/counteragents']],
        ['label' => 'Объекты</', 'class' => 'text-info', 'icon' => 'fa fa-building-o pull-right', 'url' => ['/facilities']],
        ['label' => 'Оплата', 'class' => 'text-success', 'icon' => 'fa fa-money pull-right', 'url' => ['/payment']],
        [
            'label' => 'Справочники',
            'url' => '#',
            'items' => [
                ['label' => 'Номенклатура', 'url' => ['/ps']],
                ['label' => 'Единицы измерения', 'url' => ['/units']],
                ['label' => 'Валюта', 'url' => ['/currencies']],
                ['label' => 'Регионы', 'url' => ['/regions']],
                ['label' => 'Типы номенклатуры', 'url' => ['/ps-types']],
                ['label' => 'Типы контрагентов', 'url' => ['/ca-types']],
                ['label' => 'Способы оплаты', 'url' => ['/payment-methods']],
                ['label' => 'Статусы объектов', 'url' => ['/facilities-states']],
            ],
        ],
        ['label' => 'Пользователи', 'icon' => 'fa fa-users pull-right', 'url' => ['/users']],
    ];
else
    $items = [
        ['label' => 'Контрагенты', 'class' => 'text-primary', 'icon' => 'fa fa-male pull-right', 'url' => ['/counteragents']],
        ['label' => 'Объекты</', 'class' => 'text-info', 'icon' => 'fa fa-building-o pull-right', 'url' => ['/facilities']],
        ['label' => 'Оплата', 'class' => 'text-success', 'icon' => 'fa fa-money pull-right', 'url' => ['/payment']],
        [
            'label' => 'Справочники',
            'url' => '#',
            'items' => [
                ['label' => 'Номенклатура', 'url' => ['/ps']],
                ['label' => 'Единицы измерения', 'url' => ['/units']],
                ['label' => 'Регионы', 'url' => ['/regions']],
            ],
        ],
    ];
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
<body class="<?= Yii::$app->user->isGuest ? 'blank' : 'fixed-navbar' ?>">
<?php $this->beginBody() ?>
<div id="main">
        <!-----------------------------------------------------------------+
           ".navbar" Helper Classes:
        -------------------------------------------------------------------+
           * Positioning Classes:
            '.navbar-static-top' - Static top positioned navbar
            '.navbar-static-top' - Fixed top positioned navbar

           * Available Skin Classes:
             .bg-dark    .bg-primary   .bg-success
             .bg-info    .bg-warning   .bg-danger
             .bg-alert   .bg-system
        -------------------------------------------------------------------+
          Example: <header class="navbar navbar-fixed-top bg-primary">
          Results: Fixed top navbar with blue background
        ------------------------------------------------------------------->

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top navbar-shadow bg-danger">
            <div class="navbar-branding bg-danger dark">
                <a class="navbar-brand" href="dashboard.html">
                    <?= Html::img('/images/logo32.png') ?> Дядя <strong>Витя</strong>
                </a>
                <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
            </div>
            <!-- можно еще такое меню юзать (на мобильном пропадает):
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown menu-merge hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Меню
                        <span class="caret caret-tp"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Номенклатура</a></li>
                        <li><a href="#">Автомобили</a></li>
                        <li><a href="#">Мастерские</a></li>
                        <li><a href="#">Поставщики</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Заголовок + divider после</li>
                        <li><a href="#">Плановое техобслуживание</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Документы по ремонту</a></li>
                    </ul>
                </li>
            </ul>
            -->
            <ul class="nav navbar-nav navbar-right">
                <!--
                <li class="dropdown menu-merge">
                    <div class="navbar-btn btn-group">
                        <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
                            <span class="fa fa-bell-o fs14 va-m"></span>
                            <span class="badge badge-danger">9</span>
                        </button>
                        <div class="dropdown-menu dropdown-persist w350 animated animated-shorter fadeIn" role="menu">
                            <div class="panel mbn">
                                <div class="panel-menu">
                                    <span class="panel-icon"><i class="fa fa-clock-o"></i></span>
                                    <span class="panel-title fw600"> Уведомления</span>
                                    <button class="btn btn-default light btn-xs pull-right" type="button"><i class="fa fa-refresh"></i></button>
                                </div>
                                <div class="panel-body panel-scroller scroller-navbar scroller-overlay scroller-pn pn">
                                    <ol class="timeline-list">
                                        <li class="timeline-item">
                                            <div class="timeline-icon bg-dark light">
                                                <span class="fa fa-tags"></span>
                                            </div>
                                            <div class="timeline-desc">
                                                <b>ОСАГО</b> полис необходимо
                                                <a href="#">продлить</a>
                                            </div>
                                            <div class="timeline-date">01:25</div>
                                        </li>
                                        <li class="timeline-item">
                                            <div class="timeline-icon bg-success">
                                                <span class="fa fa-usd"></span>
                                            </div>
                                            <div class="timeline-desc">
                                                <b>Даниэлла</b> пригласил(а) в
                                                <a href="#">друзья</a>
                                            </div>
                                            <div class="timeline-date">16:15</div>
                                        </li>
                                        <li class="timeline-item">
                                            <div class="timeline-icon bg-dark light">
                                                <span class="fa fa-tags"></span>
                                            </div>
                                            <div class="timeline-desc">
                                                <b>Глеб</b> оставил личное
                                                <a href="#">сообщение</a>
                                            </div>
                                            <div class="timeline-date">23:05</div>
                                        </li>
                                    </ol>

                                </div>
                                <div class="panel-footer text-center p7">
                                    <a href="#" class="link-unstyled"> Все уведомления</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="menu-divider hidden-xs">
                    <i class="fa fa-circle"></i>
                </li>
                -->
                <li class="dropdown menu-merge">
                    <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
                        <img src="<?= $avatar ?>" alt="avatar" class="mw30 br64">
                        <span class="hidden-xs pl15"> <?= $username ?> </span>
                        <span class="caret caret-tp hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                        <li class="list-group-item">
                            <?= Html::a('<span class="fa fa-gear"></span> Профиль', ['/profile'], ['class' => 'animated animated-short fadeInUp']) ?>

                        </li>
                        <li class="dropdown-footer">
                            <?= Html::a('<span class="fa fa-power-off pr5"></span> Выход', ['/logout'], ['data-method' => 'post']) ?>

                        </li>
                    </ul>
                </li>
            </ul>
        </header>
        <!-- End: Header -->

        <!-----------------------------------------------------------------+
           "#sidebar_left" Helper Classes:
        -------------------------------------------------------------------+
           * Positioning Classes:
            '.affix' - Sets Sidebar Left to the fixed position

           * Available Skin Classes:
             .sidebar-dark (default no class needed)
             .sidebar-light
             .sidebar-light.light
        -------------------------------------------------------------------+
           Example: <aside id="sidebar_left" class="affix sidebar-light">
           Results: Fixed Left Sidebar with light/white background
        ------------------------------------------------------------------->

        <!-- Start: Sidebar -->
        <aside id="sidebar_left" class="nano nano-light affix sidebar-light">

            <!-- Start: Sidebar Left Content -->
            <div class="sidebar-left-content nano-content">

                <!-- Start: Sidebar Header -->
                <header class="sidebar-header">
                    <!-- Sidebar Widget - Author -->
                    <!--
                    <div class="sidebar-widget author-widget">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img src="<?= $avatar ?>" class="img-responsive">
                            </a>
                            <div class="media-body">
                                <div class="media-links">
                                    <a href="#" class="sidebar-menu-toggle">Быстрый доступ -</a> <?= Html::a('Выход', ['/logout'], ['data-method' => 'post']) ?>

                                </div>
                                <div class="media-author"><?= $username ?></div>
                            </div>
                        </div>
                    </div>
                    -->

                    <!-- Sidebar Widget - Menu (slidedown) -->
                    <!--
                    <div class="sidebar-widget menu-widget">
                        <div class="row text-center mbn">
                            <div class="col-xs-4">
                                <a href="/" class="text-primary" data-toggle="tooltip" data-placement="top" title="Рабочий стол">
                                    <span class="glyphicon glyphicon-home"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="/autos" class="text-info" data-toggle="tooltip" data-placement="top" title="Автомобили">
                                    <span class="fa fa-car" aria-hidden="true"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
                                    <span class="glyphicon glyphicon-bell"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
                                    <span class="fa fa-desktop"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
                                    <span class="fa fa-gears"></span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
                                    <span class="fa fa-flask"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    -->
                    <!--
                    <div class="sidebar-widget search-widget hidden">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" id="sidebar-search" class="form-control" placeholder="Найти...">
                        </div>
                    </div>
                    -->
                </header>
                <!-- End: Sidebar Header -->

                <!-- Start: Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <li class="sidebar-label pt20">Главное меню</li>
                    <li class="active">
                        <a href="/">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="sidebar-title">Рабочий стол</span>
                        </a>
                    </li>
                    <li>
                        <a href="/documents">
                            <span class="fa fa-file-text"></span>
                            <span class="sidebar-title">Документы по ремонту</span>
                            <!--
                            <span class="sidebar-title-tray">
                                <span class="label label-xs bg-primary">New</span>
                            </span>
                            -->
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            <span class="glyphicon glyphicon-book"></span>
                            <span class="sidebar-title">Плановое техобслуживание</span>
                        </a>
                    </li>
                    <li class="sidebar-label pt15">Справочники</li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="glyphicon glyphicon-fire"></span>
                            <span class="sidebar-title">Основные</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <?= Html::a('<span class="glyphicon glyphicon-book"></span> Мастерские', ['/service-stations']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="glyphicon glyphicon-modal-window"></span> Поставщики', ['/suppliers']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-car"></span> Автомобили', ['/autos']) ?>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="glyphicon glyphicon-check"></span>
                            <span class="sidebar-title">Вспомогательные</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <?= Html::a('<span class="glyphicon glyphicon-shopping-cart"></span> Производители', ['/vendors']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="glyphicon glyphicon-calendar"></span> Страны', ['/countries']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-desktop"></span> Единицы измерения', ['/units']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-clipboard"></span> Типы номенклатуры', ['/nomenclature-types']) ?>

                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-label pt20">Номенклатура</li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-diamond"></span>
                            <span class="sidebar-title">Общая</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <?= Html::a('<span class="fa fa-cube"></span> Категории', ['/nomenclature-categories']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-desktop"></span> Номенклатура', ['/nomenclature-common']) ?>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-diamond"></span>
                            <span class="sidebar-title">Пользовательская</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <?= Html::a('<span class="fa fa-desktop"></span> Запчасти', ['/nomenclature-parts']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-cube"></span> Материалы', ['/nomenclature-stuff']) ?>

                            </li>
                            <li>
                                <?= Html::a('<span class="fa fa-columns"></span> Работы', ['/nomenclature-services']) ?>

                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- End: Sidebar Menu -->

                <!-- Start: Sidebar Collapse Button -->
                <div class="sidebar-toggle-mini">
                    <?= Html::a('<span class="fa fa-sign-out"></span>', ['/logout'], ['data-method' => 'post', 'title' => 'Выход']) ?>

                </div>
                <!-- End: Sidebar Collapse Button -->

            </div>
            <!-- End: Sidebar Left Content -->

        </aside>
        <!-- End: Sidebar Left -->

        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <!-- Start: Topbar -->
            <header id="topbar" class="alt affix">
                <div class="topbar-left">
                    <?= Breadcrumbs::widget([
                        'tag' => 'ol',
                        'activeItemTemplate' => "                        <li class=\"crumb-trail\">{link}</li>\n",
                        'homeLink' => [
                                'label' => 'label of the link',
                            'template' => "
                        <li class=\"crumb-icon\">
                            <a href=\"/\">
                                <span class=\"glyphicon glyphicon-home\"></span>
                            </a>
                        </li>\n",
                        ],
                        'itemTemplate' => "                        <li class=\"crumb-link\">{link}</li>\n",
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>

                </div>
                <div class="topbar-right fs18">
                    <?php if (!empty($this->blocks['content-header'])): ?>
                        <?= $this->blocks['content-header'] ?>
                    <?php endif; ?>
                </div>
            </header>
            <!-- End: Topbar -->

            <!-- Begin: Content -->
            <section id="content" class="table-layout animated fadeIn">
                <?= $content ?>

            </section>
            <!-- End: Content -->

            <footer id="content-footer" class="affix">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <span class="footer-legal">© <?= date('Y') ?> <?= Yii::$app->name ?></span>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right">
                        <span class="footer-meta">60GB of <b>350GB</b> Free</span>
                        <a href="#content" class="footer-return-top">
                            <span class="fa fa-arrow-up"></span>
                        </a>
                    </div>
                </div>
            </footer>
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
