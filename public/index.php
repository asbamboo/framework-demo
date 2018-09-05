<?php
use asbamboo\frameworkDemo\HttpKernel;

require_once dirname(dirname(__DIR__)) . '/test/bootstrap.php';

$kernel = (new HttpKernel())->run($debug = false);
