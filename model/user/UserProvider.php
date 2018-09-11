<?php
namespace asbamboo\frameworkDemo\model\user;

use asbamboo\security\user\UserInterface;
use asbamboo\security\user\provider\UserProviderInterface;
use asbamboo\di\ContainerAwareTrait;
use asbamboo\framework\Constant;
use asbamboo\database\FactoryInterface;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月30日
 */
class UserProvider implements UserProviderInterface
{
    use ContainerAwareTrait;

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
     * {@inheritDoc}
     * @see \asbamboo\security\user\provider\UserProviderInterface::loadByLoginName()
     */
    public function loadByLoginName(string $login_name) : ? UserInterface
    {
        $criteria   = [
            'user_id' => $login_name,
        ];
        $Manager    = $this->Db->getManager();
        return $Manager->getRepository(UserEntity::class)->findOneBy($criteria);
    }
}