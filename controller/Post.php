<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\http\ServerRequest;
use asbamboo\framework\Constant;
use asbamboo\database\Factory;
use asbamboo\frameworkDemo\model\user\UserEntity;
use \asbamboo\frameworkDemo\model\user\Constant AS UserConstant;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\security\user\token\UserToken;
use asbamboo\frameworkDemo\model\user\UserRepository;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月3日
 */
class Post extends ControllerAbstract
{
    /**
     *
     * @return ResponseInterface
     */
    public function index() : ResponseInterface
    {
        /**
         * @var Factory $Db
         * @var UserToken $UserToken
         */
        $Db                     = $this->Container->get(Constant::KERNEL_DB);
        $UserToken              = $this->Container->get('kernel.user.token');

        $DbManager              = $Db->getManager();
        $PostEntitys            = $DbManager->getRepository(PostEntity::class)->findBy(['User' => $UserToken->getUser()->getUserSeq()], ['post_update_time' => 'DESC']);
        return $this->view([ 'PostEntitys' => $PostEntitys]);
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
             * @var UserToken $UserToken
             * @var UserRepository $UserRepository;
             */
            $Db                     = $this->Container->get(Constant::KERNEL_DB);
            $Request                = $this->Container->get('kernel.request');
            $post_title             = $Request->getRequestParam('post_title');
            $post_content           = $Request->getRequestParam('post_content');
            $UserToken              = $this->Container->get('kernel.user.token');
            $DbManager              = $Db->getManager();
            $UserRepository         = $DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->find($UserToken->getUser()->getUserSeq());
            $PostEntity             = new PostEntity();

            if($Request->getMethod() == 'POST'){
                if(empty($post_title)){
                    throw new \InvalidArgumentException('请输入文章标题。');
                }

                if(empty($post_content)){
                    throw new \InvalidArgumentException('请输入文章内容。');
                }

                $PostEntity->setPostTitle($post_title);
                $PostEntity->setPostContent($post_content);
                $PostEntity->setUser($UserEntity);

                $DbManager->persist($PostEntity);
                $DbManager->flush();
                return $this->redirect('post');
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
    public function update($post_seq) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            /**
             * @var Factory $Db
             * @var ServerRequest $Request
             * @var UserToken $UserToken
             * @var PostEntity $PostEntity
             * @var UserRepository $UserRepository;
             */
            $Db                     = $this->Container->get(Constant::KERNEL_DB);
            $Request                = $this->Container->get('kernel.request');
            $UserToken              = $this->Container->get('kernel.user.token');
            $post_title             = $Request->getRequestParam('post_title');
            $post_content           = $Request->getRequestParam('post_content');
            $DbManager              = $Db->getManager();
            $UserRepository         = $DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->find($UserToken->getUser()->getUserSeq());
            $PostRepository         = $DbManager->getRepository(PostEntity::class);
            $PostEntity             = $PostRepository->find($post_seq);

            if($Request->getMethod() == 'POST'){
                if(empty($post_title)){
                    throw new \InvalidArgumentException('请输入文章标题。');
                }

                if(empty($post_content)){
                    throw new \InvalidArgumentException('请输入文章内容。');
                }

                if($PostEntity->getUser()->getLoginName() != $UserToken->getUser()->getLoginName()){
                    throw new \InvalidArgumentException('只能编辑自己发布的文章内容。');
                }

                $PostEntity->setPostTitle($post_title);
                $PostEntity->setPostContent($post_content);
                $PostEntity->setPostUpdateTime(time());

                $DbManager->persist($PostEntity);
                $DbManager->flush();
                return $this->redirect('post');
            }
        }catch(\Exception $e){
            $error_message  = $e->getMessage();
        }

        return $this->view(['PostEntity' => $PostEntity, 'error_message' => $error_message]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function delete() : ResponseInterface
    {
        /**
         * @var Factory $Db
         * @var UserToken $UserToken
         * @var ServerRequest $Request
         */
        $Db                     = $this->Container->get(Constant::KERNEL_DB);
        $Request                = $this->Container->get('kernel.request');
        $UserToken              = $this->Container->get('kernel.user.token');
        $post_seq               = $Request->getRequestParam('post_seq');
        $DbManager              = $Db->getManager();
        $PostRepository         = $DbManager->getRepository(PostEntity::class);
        $PostEntity             = $PostRepository->find($post_seq);

        if($Request->getMethod() == 'POST'){
            if($PostEntity->getUser()->getLoginName() != $UserToken->getUser()->getLoginName()){
                throw new \InvalidArgumentException('只能删除自己发布的文章内容。');
            }
            $DbManager->remove($PostEntity);
            $DbManager->flush();
            return $this->redirect('post');
        }
    }
}