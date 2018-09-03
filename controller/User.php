<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\http\ServerRequest;
use asbamboo\framework\Constant;
use asbamboo\database\Factory;
use asbamboo\frameworkDemo\model\user\UserEntity;
use \asbamboo\frameworkDemo\model\user\Constant AS UserConstant;

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
    public function index() : ResponseInterface
    {
        /**
         * @var Factory $Db
         */
        $Db                     = $this->Container->get(Constant::KERNEL_DB);
        $DbManager              = $Db->getManager();
        $UserEntitys            = $DbManager->getRepository(UserEntity::class)->findBy(['user_type' => UserConstant::TYPE_USER]);

        return $this->view([ 'UserEntitys' => $UserEntitys]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function create() : ResponseInterface
    {
        $error_message  = '';
        try
        {
            /**
             * @var Factory $Db
             * @var ServerRequest $Request
             */
            $Db                     = $this->Container->get(Constant::KERNEL_DB);
            $Request                = $this->Container->get('kernel.request');
            $user_id                = $Request->getRequestParam('user_id');
            $user_password          = $Request->getRequestParam('user_password');
            $user_confirm_password  = $Request->getRequestParam('user_confirm_password');
            $UserEntity             = new UserEntity();
            $DbManager              = $Db->getManager();

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
                $UserEntity->setUserType(UserConstant::TYPE_USER);

                $DbManager->persist($UserEntity);
                $DbManager->flush();
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
    public function update($user_id) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            /**
             * @var Factory $Db
             * @var ServerRequest $Request
             */
            $Db                     = $this->Container->get(Constant::KERNEL_DB);
            $Request                = $this->Container->get('kernel.request');
            $user_password          = $Request->getRequestParam('user_password');
            $user_confirm_password  = $Request->getRequestParam('user_confirm_password');
            $DbManager              = $Db->getManager();
            $UserRepository         = $DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

            if($Request->getMethod() == 'POST'){
                if(empty($user_password)){
                    throw new \InvalidArgumentException('请输入用户密码。');
                }

                if($user_confirm_password != $user_password){
                    throw new \InvalidArgumentException('两次密码输入不一致。');
                }

                $UserEntity->setUserPassword($user_password);
                $UserEntity->setUserType(UserConstant::TYPE_USER);

                $DbManager->persist($UserEntity);
                $DbManager->flush();
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
    public function delete() : ResponseInterface
    {
        /**
         * @var Factory $Db
         * @var ServerRequest $Request
         */
        $Db                     = $this->Container->get(Constant::KERNEL_DB);
        $Request                = $this->Container->get('kernel.request');
        $user_id                = $Request->getRequestParam('user_id');
        $DbManager              = $Db->getManager();
        $UserRepository         = $DbManager->getRepository(UserEntity::class);
        $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

        if($Request->getMethod() == 'POST'){
            $DbManager->remove($UserEntity);
            $DbManager->flush();
            return $this->redirect('user');
        }
    }
}