<?php
use asbamboo\framework\config\RouterConfig;
use asbamboo\framework\config\DbConfig;
use asbamboo\security\user\login\BaseLogin;
use asbamboo\frameworkDemo\model\user\UserRepository;
use asbamboo\security\user\token\UserToken;
use asbamboo\framework\template\Template;

return [
    'kernel.router.config'  => ['class' => RouterConfig::class, 'init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'router.php']],
    'kernel.db.config'      => ['class' => DbConfig::class, 'init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'db.php']],
    'kernel.template'       => ['class' => Template::class, 'init_params' => ['template_dir' => [dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view']]],
    'user.provider'         => ['class' => UserRepository::class],
    'user.token'            => ['class' => UserToken::class, 'init_params' => ['Session' => '@kernel.session']],
    'user.login'            => ['class' => BaseLogin::class, 'init_params' => ['UserProvider'=>'@user.provider', 'UserToken'=>'@user.token']],
];

