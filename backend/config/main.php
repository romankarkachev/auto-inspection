<?php
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Дядя Витя',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'enableRegistration' => false,
            'enableConfirmation' => false,
            'enablePasswordRecovery' => false,
            'enableFlashMessages' => false,
            'modelMap' => [
                'Profile' => 'common\models\Profile',
            ],
            'controllerMap' => [
                'settings' => 'backend\controllers\SettingsController',
                'security' => 'backend\controllers\SecurityController',
            ],
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
            'displayTimezone' => 'Europe/Moscow',
            'saveTimezone' => 'Europe/Moscow',
            'autoWidget' => true,
            'ajaxConversion' => true,
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '',
        ],
        'user' => [
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'default/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru_RU',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUR',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 2,
                NumberFormatter::DECIMAL_ALWAYS_SHOWN => 0,
            ],
            'nullDisplay' => '',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@backend/views/user',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green-light',
                ],
            ],
        ],
    ],
    'params' => $params,
];