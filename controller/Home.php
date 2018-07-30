<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月26日
 */
class Home extends ControllerAbstract
{
    /**
     *
     * @return \asbamboo\http\ResponseInterface
     */
    public function index()
    {
        return $this->view();
    }
}