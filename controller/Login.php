<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月30日
 */
class Login extends ControllerAbstract
{
    /**
     * 登陆表单
     *
     * @return \asbamboo\http\ResponseInterface
     */
    public function form()
    {
        return $this->view();
    }
}