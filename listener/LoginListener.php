<?php
namespace asbamboo\frameworkDemo\listener;

use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\http\RedirectResponse;
use asbamboo\router\RouterInterface;
use asbamboo\security\Event;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月1日
 */
class LoginListener
{
    /**
     *
     * @var RouterInterface
     */
    private $Router;

    /**
     *
     * @param RouterInterface $Router
     */
    public function __construct(RouterInterface $Router)
    {
        $this->Router = $Router;
    }

    public function subscribers()
    {
        return [
            Event::LOGIN_SUCCESS    => [$this, 'onLoginSuccess'],
        ];
    }

    /**
     * 登录成功页面跳回主页
     *
     * @param UserTokenInterface $UserToken
     */
    public function onLoginSuccess(UserTokenInterface $UserToken)
    {
        $redirect_url   = $this->Router->generateUrl('home');
        return (new RedirectResponse($redirect_url))->send();
    }

    /**
     *
     */
    public function onLogoutSuccess()
    {

    }
}