<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\database\FactoryInterface;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月26日
 */
class Home extends ControllerAbstract
{
    /**
     *
     * @return \asbamboo\http\ResponseInterface
     */
    public function index(FactoryInterface $Db)
    {
        /**
         * @var UserToken $UserToken
         * @var EntityRepository $PostRepository
         */
        $DbManager              = $Db->getManager();
        $PostRepository         = $DbManager->getRepository(PostEntity::class);
        $PostEntitys            = $PostRepository->findBy([], ['post_update_time' => 'DESC']);
        return $this->view([ 'PostEntitys' => $PostEntitys]);
    }
}