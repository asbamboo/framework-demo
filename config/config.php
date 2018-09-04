<?php
use asbamboo\framework\config\RouterConfig;
use asbamboo\framework\config\DbConfig;
use asbamboo\security\user\login\BaseLogin;
use asbamboo\security\user\token\UserToken;
use asbamboo\framework\template\Template;
use asbamboo\frameworkDemo\model\user\UserProvider;
use asbamboo\framework\config\EventListenerConfig;
use asbamboo\security\user\login\BaseLogout;
use asbamboo\security\gurad\authorization\Authenticator;

return [
    'kernel.router.config'          => ['class' => RouterConfig::class, 'init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'router.php']],
    'kernel.db.config'              => ['class' => DbConfig::class, 'init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'db.php']],
    'kernel.event.listener.config'  => ['class' => EventListenerConfig::class, 'init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'listener.php']],
    'kernel.template'               => ['class' => Template::class, 'init_params' => ['template_dir' => [dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view']]],
    'kernel.user.provider'          => ['class' => UserProvider::class],
    'kernel.user.token'             => ['class' => UserToken::class, 'init_params' => ['Session' => '@kernel.session']],
    'kernel.user.login'             => ['class' => BaseLogin::class, 'init_params' => ['UserProvider'=>'@kernel.user.provider', 'UserToken'=>'@kernel.user.token']],
    'kernel.user.logout'            => ['class' => BaseLogout::class, 'init_params' => ['UserToken'=>'@kernel.user.token']],
    'kernel.gurad.authenticator'    => ['class' => Authenticator::class, 'init_params' => ['RuleCollection'=>include __DIR__ . DIRECTORY_SEPARATOR . 'authorization.php']],
];

