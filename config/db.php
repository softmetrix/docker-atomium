<?php
$dsn = getenv('DB_DSN');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
return [
   'class' => 'yii\db\Connection',
   'dsn' => $dsn,
   'username' => $user,
   'password' => $pass,
   'charset' => 'utf8',
];
