<?php
use asbamboo\frameworkDemo\model\user\UserProvider;
use asbamboo\framework\config\RouterConfig;
use asbamboo\framework\config\DbConfig;
use asbamboo\framework\config\EventListenerConfig;
use asbamboo\framework\template\Template;
use asbamboo\security\user\login\Login;
use asbamboo\security\gurad\authorization\Authenticator;
use asbamboo\api\apiStore\ApiStore;
use asbamboo\api\apiStore\validator\TimestampChecker;
use asbamboo\api\apiStore\validator\CheckerCollection;
use asbamboo\frameworkDemo\api\SignChecker;
use asbamboo\api\apiStore\ApiRequestUri;
use asbamboo\api\apiStore\ApiRequestUris;

return [
    DbConfig::class             =>
        ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'db.php']],
    UserProvider::class         =>
        ['class' => UserProvider::class],
    Login::class                =>
        ['init_params' => ['UserProvider' => '@'.UserProvider::class]],
    RouterConfig::class         =>
        ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'router.php']],
    Template::class             =>
        ['init_params' => ['template_dir' => [dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view']]],
    EventListenerConfig::class  =>
        ['init_params' => ['configs' => include __DIR__ . DIRECTORY_SEPARATOR . 'listener.php']],
    Authenticator::class        =>
        ['init_params' => ['RuleCollection' => include __DIR__ . DIRECTORY_SEPARATOR . 'authorization.php']],
    ApiStore::class             =>
        ['init_params' => ['namespace' => 'asbamboo\\frameworkDemo\\api\\store', 'dir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'store']],
    TimestampChecker::class     =>
        ['class' => TimestampChecker::class],
    SignChecker::class          =>
        ['class' => SignChecker::class],
    CheckerCollection::class    =>
        ['init_params' => ['@'.TimestampChecker::class, '@'.SignChecker::class]],
    ApiRequestUri::class        =>
        ['init_params' => ['http://' . ($_SERVER['HTTP_HOST'] ?? 'xxx')  . '/api', '测试请求地址', 'test']],
    ApiRequestUris::class       =>
        ['init_params' => ['@'.ApiRequestUri::class]],
];

