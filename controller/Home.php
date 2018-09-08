<?php
namespace asbamboo\frameworkDemo\controller;

use asbamboo\framework\controller\ControllerAbstract;
use asbamboo\framework\Constant;
use asbamboo\frameworkDemo\model\post\PostEntity;
use Doctrine\ORM\EntityRepository;
use asbamboo\database\Factory;
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
     * @var FactoryInterface
     */
    private $Db;

    /**
     *
     * @param FactoryInterface $Db
     */
    public function __construct(FactoryInterface $Db)
    {
        $this->Db   = $Db;
    }

    /**
     *
     * @return \asbamboo\http\ResponseInterface
     */
    public function index()
    {
        /**
         * @var UserToken $UserToken
         * @var EntityRepository $PostRepository
         */
        $DbManager              = $this->Db->getManager();
        $PostRepository         = $DbManager->getRepository(PostEntity::class);
        $PostEntitys            = $PostRepository->findBy([], ['post_update_time' => 'DESC']);
        return $this->view([ 'PostEntitys' => $PostEntitys]);
    }
}