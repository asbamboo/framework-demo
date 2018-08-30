<?php
return  [
    ['id' => 'home', 'path' => '/' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Home:index'],
    ['id' => 'login', 'path' => '/login' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Login:form'],
    ['id' => 'login_action', 'path' => '/login-action' , 'callback' => 'asbamboo\\frameworkDemo\\controller\\Login:action'],
];