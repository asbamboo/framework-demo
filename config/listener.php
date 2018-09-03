<?php
use asbamboo\security\Event;
use asbamboo\frameworkDemo\listener\LoginListener;

return [
    ['name' => Event::LOGIN_SUCCESS, 'class' => LoginListener::class, 'method' => 'onLoginSuccess', 'construct_params' => ['@kernel.router']],
];