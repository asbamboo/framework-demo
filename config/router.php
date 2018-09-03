<?php
return  [
    ['id' => 'home', 'path' => '/' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Home:index'],
    ['id' => 'login', 'path' => '/login' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Login:form'],
    ['id' => 'user', 'path' => '/user' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:index'],
    ['id' => 'user_create', 'path' => '/user-create' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:create'],
    ['id' => 'user_update', 'path' => '/{user_id}/user-update' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:update'],
    ['id' => 'user_delete', 'path' => '/user-delete' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\User:delete'],
];