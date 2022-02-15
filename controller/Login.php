<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\security\exception\UserNotExistsException;
use asbamboo\security\exception\NotEqualPasswordException;
use asbamboo\http\ServerRequestInterface;
use asbamboo\security\user\login\LoginInterface;
use asbamboo\security\user\login\LogoutInterface;

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
    public function form(ServerRequestInterface $Request, LoginInterface $Login) : ResponseInterface
    {
        $error_message    = '';
        try
        {
            /**
             * 登录成功后通过事件处理页面跳转。
             */
            if($Request->getMethod() == 'POST'){
                $Login->handler($Request);
            }
        }catch(UserNotExistsException $e){
            $error_message    = '用户名或者密码错误';
        }catch(NotEqualPasswordException $e){
            $error_message    = '用户名或者密码错误';
        }catch(\Exception $e){
            $error_message    = '系统异常。';
        }
        return $this->view(['error_message' => $error_message]);
    }

    /**
     * 注销
     *
     * @return \asbamboo\http\ResponseInterface
     */
    public function logout(ServerRequestInterface $Request, LogoutInterface $Logout)
    {
        $Logout->handler($Request);
        return $this->redirect('home');
    }
}