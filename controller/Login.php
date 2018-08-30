<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\security\user\login\BaseLogin;
use asbamboo\http\ResponseInterface;

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
    public function form() : ResponseInterface
    {
        return $this->view();
    }

    /**
     *
     */
    public function action()
    {
        /**
         *
         * @var BaseLogin $ServerLogin
         */
        $Login      = $this->Container->get('user.login');
        $Request    = $this->Container->get('kernel.request');
        $Login->handler($Request);
        echo 'ok';
        exit;
    }
}