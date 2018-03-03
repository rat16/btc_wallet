<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'  => 'wallet',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hequan!@#$1234%%%stamhe',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
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
                    'levels' => ['error', 'warning', 'info', 'trace'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db2'	=> array(
        		'class' => 'yii\db\Connection',
        		'dsn' => 'mysql:host=127.0.0.1;dbname=yii2',
        		'username' => 'root',
        		'password' => '123456',
        		'charset' => 'utf8',
        ),
        'urlManager' => [
            'enablePrettyUrl'	=> true,		// 启用url美化
            'showScriptName' 	=> false,		// 将url中的index.php隐藏掉
//             'suffix'			=> '.html',		// 开启伪静态
            'suffix'			=> '',		// 开启伪静态
//             'caseSensitive'		=> true,		// 路由是否区分大小写
            'rules' => [
            	'<controller:country>/<action:\w+>'=>'<controller>/<action>',		// 匹配固定的控制器
            	'<controller:country>/<action:conf2>/<id:\d+>'=>'<controller>/<action>',		// 匹配固定的控制器或者方法
				
            ],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 1,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
