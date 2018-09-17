<?php
use asbamboo\security\Event;
use asbamboo\frameworkDemo\listener\LoginListener;
use asbamboo\router\RouterInterface;

return [
    ['name' => Event::LOGIN_SUCCESS, 'class' => LoginListener::class, 'method' => 'onLoginSuccess', 'construct_params' => ['@'.RouterInterface::class]],
];