<?php
return  [
    ['id' => 'home', 'path' => '/' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Home:index'],
    ['id' => 'login', 'path' => '/login' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Login:form'],
    ['id' => 'logout', 'path' => '/logout' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Login:logout'],
    ['id' => 'user', 'path' => '/user' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:index'],
    ['id' => 'user_create', 'path' => '/user-create' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:create'],
    ['id' => 'user_update', 'path' => '/{user_id}/user-update' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:update'],
    ['id' => 'user_delete', 'path' => '/user-delete' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:delete'],
    ['id' => 'post', 'path' => '/post' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Post:index'],
    ['id' => 'post_create', 'path' => '/post-create' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Post:create'],
    ['id' => 'post_update', 'path' => '/{post_seq}/post-update' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Post:update'],
    ['id' => 'post_delete', 'path' => '/post-delete' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Post:delete'],
];