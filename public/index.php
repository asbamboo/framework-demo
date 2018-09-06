<?php

use asbamboo\frameworkDemo\AppKernel;
use asbamboo\framework\kernel\Http;

require_once dirname(dirname(__DIR__)) . '/test/bootstrap.php';

/**
 * http请求入口文件
 */
(new Http())->run(new AppKernel($debug = true));