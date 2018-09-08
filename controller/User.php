<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\http\ServerRequest;
use asbamboo\framework\Constant;
use asbamboo\database\Factory;
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
    private $DbManager;

    private $Request;

    public function __construct(FactoryInterface $Db, ServerRequestInterface $Request)
    {
        $this->DbManager   = $Db->getManager();
        $this->Request      = $Request;
    }

    /**
     *
     * @return ResponseInterface
     */
    public function index() : ResponseInterface
    {
        $UserEntitys            = $this->DbManager->getRepository(UserEntity::class)->findBy(['user_type' => UserConstant::TYPE_USER]);

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
            $user_id                = $this->Request->getPostParam('user_id');
            $user_password          = $this->Request->getPostParam('user_password');
            $user_confirm_password  = $this->Request->getPostParam('user_confirm_password');
            $UserEntity             = new UserEntity();

            if($this->Request->getMethod() == 'POST'){
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

                $this->DbManager->persist($UserEntity);
                $this->DbManager->flush();
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
            $user_password          = $this->Request->getPostParam('user_password');
            $user_confirm_password  = $this->Request->getPostParam('user_confirm_password');
            $UserRepository         = $this->DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

            if($this->Request->getMethod() == 'POST'){
                if(empty($user_password)){
                    throw new \InvalidArgumentException('请输入用户密码。');
                }

                if($user_confirm_password != $user_password){
                    throw new \InvalidArgumentException('两次密码输入不一致。');
                }

                $UserEntity->setUserPassword($user_password);
                $UserEntity->setUserType(UserConstant::TYPE_USER);

                $this->DbManager->persist($UserEntity);
                $this->DbManager->flush();
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
        $user_id                = $this->Request->getPostParam('user_id');
        $UserRepository         = $this->DbManager->getRepository(UserEntity::class);
        $UserEntity             = $UserRepository->findOneBy(['user_id' => $user_id]);

        if($this->Request->getMethod() == 'POST'){
            $this->DbManager->remove($UserEntity);
            $this->DbManager->flush();
            return $this->redirect('user');
        }
    }
}