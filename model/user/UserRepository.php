<?php
namespace asbamboo\frameworkDemo\model\user;

use asbamboo\security\user\provider\UserProviderInterface;
use asbamboo\security\user\UserInterface;
use asbamboo\database\EntityRepository;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月30日
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{
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
        return $this->findOneBy($criteria);
    }
}