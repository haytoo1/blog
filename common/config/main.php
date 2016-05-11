<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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

        // URL美化
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false, // 隐藏index.php
            'rules' => [
                'main'=>'site/index'
            ],
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
    ]
];
