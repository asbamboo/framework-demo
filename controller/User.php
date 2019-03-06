<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\frameworkDemo\model\user\UserEntity;
use \asbamboo\frameworkDemo\model\user\Constant AS UserConstant;
use asbamboo\database\FactoryInterface;
use asbamboo\http\ServerRequestInterface;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月3日
 */
class User extends ControllerAbstract
{
    /**
     *
     * @return ResponseInterface
     */
    public function index(FactoryInterface $Db) : ResponseInterface
    {
        $UserEntitys            = $Db->getManager()->getRepository(UserEntity::class)->findBy(['user_type' => UserConstant::TYPE_USER]);

        return $this->view([ 'UserEntitys' => $UserEntitys]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function create(ServerRequestInterface $Request, FactoryInterface $Db) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            $user_id                = $Request->getPostParam('user_id');
            $user_security          = $Request->getPostParam('user_security');
            $user_password          = $Request->getPostParam('user_password');
            $user_confirm_password  = $Request->getPostParam('user_confirm_password');
            $UserEntity             = new UserEntity();

            if($Request->getMethod() == 'POST'){
                if(empty($user_id)){
                    throw new \InvalidArgumentException('请输入用户id。');
                }

                if(empty($user_password)){
                    throw new \InvalidArgumentException('请输入用户密码。');
                }

                if($user_confirm_password != $user_password){
                    throw new \InvalidArgumentException('两次密码输入不一致。');
                }

                $UserEntity->setUserId($user_id);
                $UserEntity->setUserPassword($user_password);
                $UserEntity->setUserSecurity($user_security);
                $UserEntity->setUserType(UserConstant::TYPE_USER);

                $Db->getManager()->persist($UserEntity);
                $Db->getManager()->flush();
                return $this->redirect('user');
            }
        }catch(\Exception $e){
            $error_message  = $e->getMessage();
        }

        return $this->view(['error_message' => $error_message]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function update($user_id, ServerRequestInterface $Request, FactoryInterface $Db) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            $user_security          = $Request->getPostParam('user_security');
            $user_password          = $Request->getPostParam('user_password');
            $user_confirm_password  = $Request->getPostParam('user_confirm_password');
            $UserRepository         = $Db->getManager()->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

            if($Request->getMethod() == 'POST'){
                if(empty($user_password)){
                    throw new \InvalidArgumentException('请输入用户密码。');
                }

                if($user_confirm_password != $user_password){
                    throw new \InvalidArgumentException('两次密码输入不一致。');
                }

                $UserEntity->setUserPassword($user_password);
                $UserEntity->setUserSecurity($user_security);
                $UserEntity->setUserType(UserConstant::TYPE_USER);

                $Db->getManager()->persist($UserEntity);
                $Db->getManager()->flush();
                return $this->redirect('user');
            }
        }catch(\Exception $e){
            $error_message  = $e->getMessage();
        }

        return $this->view(['UserEntity' => $UserEntity, 'error_message' => $error_message]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function delete(ServerRequestInterface $Request, FactoryInterface $Db) : ResponseInterface
    {
        $user_id                = $Request->getPostParam('user_id');
        $UserRepository         = $Db->getManager()->getRepository(UserEntity::class);
        $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

        if($Request->getMethod() == 'POST'){
            $Db->getManager()->remove($UserEntity);
            $Db->getManager()->flush();
            return $this->redirect('user');
        }
    }
}