<?php

use asbamboo\frameworkDemo\AppKernel;
use asbamboo\framework\kernel\Http;

// $autoload   = require_once dirname(__DIR__) . '/vendor/asbamboo/autoload/bootstrap.php';
// $autoload->addMappingDir('asbamboo\\frameworkDemo\\', dirname(__DIR__));
$autoload   = require_once dirname(dirname(__DIR__)) . '/test/bootstrap.php';


/**
 * http请求入口文件
 */
(new Http())->run(new AppKernel($debug = true));