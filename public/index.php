<?php
require_once __DIR__ . '/vendor/autoload.php';

use asbamboo\framework\_test\fixtures\HttpKernel;

$kernel = (new HttpKernel())->run();
