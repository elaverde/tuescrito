<?php
define('APP_NAME',   "Amanda");
define('DB_ADAPTER', "mysql");
define('DB_HOST',    "localhost");
define('DB_NAME',    "amanda");
define('DB_PORT',    "3306");
define('DB_USER',    "elaverde");
define('DB_PASS',    "elaverde");
define('DB_CHARSET', "utf8");
define('DB_COLLATE', "utf8_unicode_ci");
define('DB_PREFIX',  "");
$config = [
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
return $config['phinx'];