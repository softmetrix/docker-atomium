<?php
$scriptsPath = getenv('SCRIPTS_PATH');
$appUrl = getenv('APP_URL');
$mailHost = getenv('MAIL_HOST');
$mailUser = getenv('MAIL_USER');
$mailPass = getenv('MAIL_PASS');
$mailPort = getenv('MAIL_PORT');
$mailEncrypt = getenv('MAIL_ENCRYPT');
$mailFrom = getenv('MAIL_FROM');
$umUser = getenv('UM_USER');
$umPass = getenv('UM_PASS');
return [
    'steps_path' => '/var/www/html/scripts/steps',
    'jobs_path' => '/var/www/html/scripts/jobs',
    'base_url' => $appUrl,
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => $mailHost,
            'username' => $mailUser,
            'password' => $mailPass,
            'port' => $mailPort,
            'encryption' => $mailEncrypt,
        ],
    ],
    'mailer_from' => 'yourmail@yourserver.com',
    'users' => [
        1 => [
            'id' => 1,
            'username' => $umUser,
            'password' => $umPass,
            'accessToken' => uniqid(),
            'authKey' => uniqid()
        ]
    ]
];
