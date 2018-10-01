<?php
use asbamboo\security\Event AS SecurityEvent;
use asbamboo\api\Event AS ApiEvent;
use asbamboo\frameworkDemo\listener\LoginListener;
use asbamboo\router\RouterInterface;
use asbamboo\api\eventListener\ApiPreExecUseCheckerListener;
use asbamboo\api\apiStore\validator\CheckerCollection;

return [
    ['name' => SecurityEvent::LOGIN_SUCCESS, 'class' => LoginListener::class, 'method' => 'onLoginSuccess', 'construct_params' => ['@'.RouterInterface::class]],
    ['name' => ApiEvent::API_PRE_EXEC, 'class' => ApiPreExecUseCheckerListener::class, 'method' => 'onCheck', 'construct_params' => ['@'.CheckerCollection::class]],
];