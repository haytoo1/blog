<?php
$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // 数据库配置
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=211.149.208.43;dbname=community',
            'username' => 'too',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        /*'filecache' => [
            'class' => 'yii\caching\FileCache',
        ],*/

        // 配置redis连接
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        // redis接管cache
        'cache'=>[
            'class'=>'yii\redis\Cache'
        ],
        // redis接管session
        'session'=>[
            'class'=>'yii\redis\Session'
        ],

        // 邮件配置
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'htmlLayout'=>'@common/mail/layouts/html',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',
                'username' => 'hayto@foxmail.com',
                'password' => 'tpztsvggjfhfbifh',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

    ],

];
if(YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}
return $config;