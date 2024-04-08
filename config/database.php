<?php

return [
    'connections' => [
        'mysql' => [
            'host'     => $_ENV['DB_HOST'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'dbname'   => $_ENV['DB_DATABASE'],
            'driver'   => 'pdo_mysql',
        ]
    ]
];