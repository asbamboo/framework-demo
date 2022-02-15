<?php

use asbamboo\frameworkDemo\AppKernel;
use asbamboo\framework\kernel\Http;

$autoload   = require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * http请求入口文件
 */
(new Http())->run(new AppKernel($debug = true));