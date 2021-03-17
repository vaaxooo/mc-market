<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'homeUrl' => '/',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'formatter' => [
            'defaultTimeZone' => 'Europe/Moscow',
        ], 
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bf5a14b224ff99991ed15223015970d5',
            'baseUrl'=> '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru', 'en'],
            'enableDefaultLanguageUrlCode' => true,
            'rules' => [
                '' => 'site/dashboard',
                'api' => 'site/api',
                'info/<id:>' => 'site/info',
                'trade' => 'site/trade',
                'docs' => 'cabinet/docs',
                'cabinet/items/add' => 'cabinet/add',
                'cabinet/items/info/<id:>' => 'cabinet/itemsinfo',

                'mcpe/plugins/view/<id:>' => 'site/view',
                'mcpe/maps/view/<id:>' => 'site/view',
                'mcpc/plugins' => 'site/mcpcplugins',
                'mcpc/maps' => 'site/mcpcmaps',
                'mcpe/plugins' => 'site/mcpeplugins',
                'mcpe/maps' => 'site/mcpemaps',
                'admin/users/ban/<id:>' => 'admin/banned',
                'admin/items/activate/<id:>' => 'admin/itemsactivate',
                'admin/items/remove/<id:>' => 'admin/itemsremove',
                'admin/promocodes/delete/<id:>' => 'admin/deletepromocode',
                'freekassa/result' => 'freekassa/result',
                'freekassa/success' => 'freekassa/success',
                '<action>' => 'site/<action>',      
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'language*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/common',
                ],
            ],
        ],
    ],
    'params' => $params,
];

/*if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}*/

return $config;
