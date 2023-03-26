<?php
return [
    'file'     => [
        'storage' => storage_path('backups/'),
    ],
    'database' => [
        'driver'   => env('DB_CONNECTION'),
        'host'     => env('DB_HOST', '127.0.0.1'),
        'port'     => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
    ],
    'options'  => [
        'mysql' => [
            /**
             *  --column-statistics=0  @Write ANALYZE TABLE statements to generate statistics histogram
             *  --no-create-info Do not write CREATE TABLE statements that create each dumped table.
             *  --skip-add-drop-table --skip-add-lock --no-create-info --replace
             **/
            'column-statistics'   => [
                'key'    => '--column-statistics=0',
                'active' => false,
            ],
            'single-transaction'  => [
                'key'    => '--single-transaction',
                'active' => false,
            ],
            'skip-add-drop-table' => [
                'key'    => '--skip-add-drop-table',
                'active' => true,
            ],
            'skip-add-lock'       => [
                'key'    => '--skip-add-lock',
                'active' => false,
            ],
            'insert-ignore'       => [
                'key'    => '--insert-ignore',
                'active' => false,
            ],
            'replace'             => [
                'key'    => '--replace',
                'active' => true,
            ],
            'no-create-info'      => [
                'key'    => '--no-create-info',
                'active' => true,
            ],
            'complete-insert'     => [
                'key'    => '--complete-insert',
                'active' => false,
            ],
        ],
    ],
    'export'   => [
        'table' => [
            'teams',
            'matches',
            'members',
            'lineups',
            'tactics',
            'stats',
        ],
    ],
];
