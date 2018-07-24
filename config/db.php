<?php
return [
    'connection'    => [
        'driver'    => 'pdo_sqlite',
        'path'      =>  dirname(__DIR__) . '/data/db.sqlite',
    ],'metadata'    => [
        'path'      => dirname(__DIR__) . '/model',
        'type'      => 'annotation',
    ],'is_dev'      => true,
];