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
use asbamboo\database\FactoryInterface;
use asbamboo\security\user\token\UserTokenInterface;
use asbamboo\database\ManagerInterface;
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
     * @var ManagerInterface
     */
    private $DbManager;

    /**
     *
     * @var UserTokenInterface
     */
    private $UserToken;

    /**
     *
     * @var ServerRequestInterface
     */
    private $Request;

    /**
     *
     * @param FactoryInterface $Db
     * @param UserTokenInterface $UserToken
     * @param ServerRequestInterface $Request
     */
    public function __construct(FactoryInterface $Db, UserTokenInterface $UserToken, ServerRequestInterface $Request)
    {
        $this->DbManager    = $Db->getManager();
        $this->UserToken    = $UserToken;
        $this->Request      = $Request;
    }

    /**
     *
     * @return ResponseInterface
     */
    public function index() : ResponseInterface
    {
        $PostEntitys    = $this->DbManager->getRepository(PostEntity::class)->findBy([
            'User' => $this->UserToken->getUser()->getUserSeq()],
            ['post_update_time' => 'DESC']
        );
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
             * @var UserRepository $UserRepository;
             */
            $post_title             = $this->Request->getPostParam('post_title');
            $post_content           = $this->Request->getPostParam('post_content');
            $UserToken              = $this->Container->get('kernel.user.token');
            $UserRepository         = $this->DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->find($this->UserToken->getUser()->getUserSeq());
            $PostEntity             = new PostEntity();

            if($this->Request->getMethod() == 'POST'){
                if(empty($post_title)){
                    throw new \InvalidArgumentException('请输入文章标题。');
                }

                if(empty($post_content)){
                    throw new \InvalidArgumentException('请输入文章内容。');
                }

                $PostEntity->setPostTitle($post_title);
                $PostEntity->setPostContent($post_content);
                $PostEntity->setUser($UserEntity);

                $this->DbManager->persist($PostEntity);
                $this->DbManager->flush();
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
             * @var PostEntity $PostEntity
             * @var UserRepository $UserRepository;
             */
            $post_title             = $this->Request->getPostParam('post_title');
            $post_content           = $this->Request->getPostParam('post_content');
            $UserRepository         = $this->DbManager->getRepository(UserEntity::class);
            $UserEntity             = $UserRepository->find($this->UserToken->getUser()->getUserSeq());
            $PostRepository         = $this->DbManager->getRepository(PostEntity::class);
            $PostEntity             = $PostRepository->find($post_seq);

            if($this->Request->getMethod() == 'POST'){
                if(empty($post_title)){
                    throw new \InvalidArgumentException('请输入文章标题。');
                }

                if(empty($post_content)){
                    throw new \InvalidArgumentException('请输入文章内容。');
                }

                if($PostEntity->getUser()->getLoginName() != $this->UserToken->getUser()->getLoginName()){
                    throw new \InvalidArgumentException('只能编辑自己发布的文章内容。');
                }

                $PostEntity->setPostTitle($post_title);
                $PostEntity->setPostContent($post_content);
                $PostEntity->setPostUpdateTime(time());

                $this->DbManager->persist($PostEntity);
                $this->DbManager->flush();
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
        $post_seq               = $this->Request->getPostParam('post_seq');
        $PostRepository         = $this->DbManager->getRepository(PostEntity::class);
        $PostEntity             = $PostRepository->find($post_seq);

        if($this->Request->getMethod() == 'POST'){
            if($PostEntity->getUser()->getLoginName() != $this->UserToken->getUser()->getLoginName()){
                throw new \InvalidArgumentException('只能删除自己发布的文章内容。');
            }
            $this->DbManager->remove($PostEntity);
            $this->DbManager->flush();
            return $this->redirect('post');
        }
    }
}