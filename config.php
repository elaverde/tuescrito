<?php
define('APP_NAME',   $_ENV['APP_NAME']);
define('DB_ADAPTER', $_ENV['DB_DRIVER']);
define('DB_HOST',    $_ENV['DB_HOST']);
define('DB_NAME',    $_ENV['DB_DATABASE']);
define('DB_PORT',    $_ENV['DB_PORT']);
define('DB_USER',    $_ENV['DB_USER']);
define('DB_PASS',    $_ENV['DB_PASSWORD']);
define('DB_CHARSET', $_ENV['DB_CHARSET']);
define('DB_COLLATE', $_ENV['DB_COLLATION']);
define('DB_PREFIX',  $_ENV['DB_PREFIX']);


$config = [
    'slim' => [
        'settings' => [
            'app_name' => APP_NAME,
            'displayErrorDetails' => true,
            'addContentLengthHeader' => false,
            'db' => [
                'driver' =>   DB_ADAPTER,
                'host' =>     DB_HOST,
                'database' => DB_NAME,
                'username' => DB_USER,
                'password' => DB_PASS,
                'charset' =>  DB_CHARSET,
                'collation'=> DB_COLLATE,
                'prefix' =>   DB_PREFIX,
            ],
        ]
    ],
    'phinx' =>  [
        'paths' => [
            'migrations' => 'database/migrations'
        ],
        'migration_base_class' => '\Migrations\Migration',
        'environments' => [
            'default_database' => 'dev',
            'dev' => [
                'adapter' => DB_ADAPTER,
                'host' => DB_HOST,
                'name' => DB_NAME,
                'user' => DB_USER,
                'pass' => DB_PASS,
                'port' => DB_PORT
            ]
        ]
    ]
];
