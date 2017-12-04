<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'settings' => [
            'class' => 'backend\modules\settings\Settings',
        ],
    ],
    'components' => [
//        'i18n' => [ // configuration for translations
//            'translations' => [
//                'app' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    //'basePath' => '@app/messages', // this is the default path for translated files, uncomment if you change
//                    'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php'
//                    ]
//                ]
//            ],
//        ],
        // there 2 tables on db message (string translated on a specific language) & source_message (containing string to be translated)
        'i18n' => [ // configuration for db translations
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    //'basePath' => '@app/messages', // this is the default path for translated files, uncomment if you change
                    'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php'
//                    ]
                ]
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'MyComponent' => [
            'class' => 'backend\components\MyComponent'
        ]
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'as beforRequest' => [ // component for before request event, to check if user is logged in
        'class' => 'backend\components\CheckIfLoggedIn',
    ],
    'params' => $params,
];
