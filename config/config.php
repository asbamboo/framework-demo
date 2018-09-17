<?php
use asbamboo\frameworkDemo\model\user\UserProvider;
use asbamboo\framework\config\RouterConfig;
use asbamboo\framework\config\DbConfig;
use asbamboo\framework\config\EventListenerConfig;
use asbamboo\framework\template\Template;
use asbamboo\security\user\login\Login;

return [
    DbConfig::class             => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'db.php']],
    UserProvider::class         => ['class' => UserProvider::class],
    Login::class                => ['init_params' => ['UserProvider' => '@'.UserProvider::class]],
    RouterConfig::class         => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'router.php']],
    Template::class             => ['init_params' => ['template_dir' => [dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view']]],
    EventListenerConfig::class  => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'listener.php']],
];

