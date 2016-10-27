<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersNomenclatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchApplied bool */

$this->title = 'Запчасти | '.Yii::$app->name;
$this->params['breadcrumbs'][] = 'Запчасти';
$this->blocks['table-header'] = 'Запчасти';
?>
<div class="users-nomenclature-list">
    <?= $this->render('_search', ['model' => $searchModel, 'searchApplied' => $searchApplied,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'panel'],
        'layout' => '
<div class="panel-heading">
    <span class="panel-title"><span class="fa fa-table"></span>'.$this->blocks['table-header'].'</span>
    <div class="pull-right">
        '.Html::a('<i class="fa fa-plus-circle"></i> Создать', ['/nomenclature/new'], ['class' => 'btn btn-success btn-gradient btn-sm', 'title' => 'Создать новый элемент']).'
        '.Html::a('<i class="fa fa-filter"></i> Отбор', ['#frm-search'], ['class' => 'btn btn-'.($searchApplied ? 'info' : 'default').' btn-gradient btn-sm', 'data-toggle' => 'collapse', 'aria-expanded' => 'false', 'aria-controls' => 'frm-search']).'
    </div>
</div>
<div class="panel-body pn">
            <div class="table-responsive">{items}</div>
        </div>
        <div class="panel-footer">{summary}<div class="pull-right">{pager}</div></div>',
        'tableOptions' => [
            'class' => 'table table-striped table-hover'
        ],
        'columns' => [
            [
                'attribute' => 'nomenclatureType',
                'options' => ['width' => '80'],
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
            ],
            'nomenclatureName',
            'notes:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa fa-pencil"></i>', $url, ['title' => Yii::t('yii', 'Редактировать'), 'class' => 'btn btn-xs btn-default']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa fa-trash-o"></i>', $url, ['title' => Yii::t('yii', 'Удалить'), 'class' => 'btn btn-xs btn-danger', 'aria-label' => Yii::t('yii', 'Delete'), 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'data-pjax' => '0',]);
                    }
                ],
                'options' => ['width' => '80'],
            ],
        ],
    ]); ?>

</div>
