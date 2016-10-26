<?php

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/bootbox';
    public $js = [
        'bootbox.js',
    ];

    public static function overrideSystemConfirm()
    {
        Yii::$app->view->registerJs('
yii.confirm = function (message, ok, cancel) {
    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {
                    label: "Да"
                },
                cancel: {
                    label: "Отмена"
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    return false;
}
        ');

        // еще вариант с https://nix-tips.ru/yii2-dialogi-confirm-v-stile-bootstrap.html
        // именно javascript:
//        yii.confirm = function(message, ok, cancel) {
//            bootbox.confirm(message, function(result) {
//                if (result) { !ok || ok(); } else { !cancel || cancel(); }
//            });
//        }
    }
}