<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\http\ResponseInterface;
use asbamboo\frameworkDemo\model\user\UserEntity;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\database\FactoryInterface;
use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\http\ServerRequestInterface;

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
    public function index(FactoryInterface $Db, UserTokenInterface $UserToken) : ResponseInterface
    {
        $PostEntitys    = $Db->getManager()->getRepository(PostEntity::class)->findBy([
            'User' => $UserToken->getUser()->getUserSeq()],
            ['post_update_time' => 'DESC']
        );
        return $this->view([ 'PostEntitys' => $PostEntitys]);
    }

    /**
     *
     * @return ResponseInterface
     */
    public function create(FactoryInterface $Db, UserTokenInterface $UserToken, ServerRequestInterface $Request) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            /**
             * @var UserRepository $UserRepository;
             */
            $post_title             = $Request->getPostParam('post_title');
            $post_content           = $Request->getPostParam('post_content');
            $UserRepository         = $Db->getManager()->getRepository(UserEntity::class);
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

                $Db->getManager()->persist($PostEntity);
                $Db->getManager()->flush();
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
    public function update($post_seq, ServerRequestInterface $Request, FactoryInterface $Db, UserTokenInterface $UserToken) : ResponseInterface
    {
        $error_message  = '';
        try
        {
            /**
             * @var PostEntity $PostEntity
             * @var UserRepository $UserRepository;
             */
            $post_title             = $Request->getPostParam('post_title');
            $post_content           = $Request->getPostParam('post_content');
            $UserRepository         = $Db->getManager()->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->find($UserToken->getUser()->getUserSeq());
            $PostRepository         = $Db->getManager()->getRepository(PostEntity::class);
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

                $Db->getManager()->persist($PostEntity);
                $Db->getManager()->flush();
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
    public function delete(ServerRequestInterface $Request, FactoryInterface $Db, UserTokenInterface $UserToken) : ResponseInterface
    {
        $post_seq               = $Request->getPostParam('post_seq');
        $PostRepository         = $Db->getManager()->getRepository(PostEntity::class);
        $PostEntity             = $PostRepository->find($post_seq);

        if($Request->getMethod() == 'POST'){
            if($PostEntity->getUser()->getLoginName() != $UserToken->getUser()->getLoginName()){
                throw new \InvalidArgumentException('只能删除自己发布的文章内容。');
            }
            $Db->getManager()->remove($PostEntity);
            $Db->getManager()->flush();
            return $this->redirect('post');
        }
    }
}