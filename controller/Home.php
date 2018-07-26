<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\Response;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月26日
 */
class Home extends ControllerAbstract
{
    public function index()
    {
        var_dump(1111);
        exit;
        return new Response('111;');
    }
}