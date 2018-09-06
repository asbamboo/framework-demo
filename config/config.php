<?php
use asbamboo\frameworkDemo\model\user\UserProvider;

return [
    'kernel.router.config'          => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'router.php']],
    'kernel.db.config'              => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'db.php']],
    'kernel.event.listener.config'  => ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'listener.php']],
//     asbamboo/framework 中 kernel.template默认视图view的目录时 {项目跟目录}/view,
//     'kernel.template'               => ['init_params' => ['template_dir' => [dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view']]],
    'kernel.gurad.authenticator'    => ['init_params' => ['RuleCollection'=>include __DIR__ . DIRECTORY_SEPARATOR . 'authorization.php']],
    'kernel.user.provider'          => ['class' => UserProvider::class],
];

