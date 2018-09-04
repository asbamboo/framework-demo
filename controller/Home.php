<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\framework\Constant;
use asbamboo\frameworkDemo\model\post\PostEntity;
use Doctrine\ORM\EntityRepository;

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
    public function index()
    {
        /**
         * @var Factory $Db
         * @var UserToken $UserToken
         * @var EntityRepository $PostRepository
         */
        $Db                     = $this->Container->get(Constant::KERNEL_DB);
        $DbManager              = $Db->getManager();
        $PostRepository         = $DbManager->getRepository(PostEntity::class);
        $PostEntitys            = $PostRepository->findBy([], ['post_update_time' => 'DESC']);
        return $this->view([ 'PostEntitys' => $PostEntitys]);
    }
}