<?php
namespace asbamboo\frameworkDemo\model\user;

use asbamboo\security\user\UserInterface;
use asbamboo\security\user\provider\UserProviderInterface;
use asbamboo\di\ContainerAwareTrait;
use asbamboo\framework\Constant;

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
     * {@inheritDoc}
     * @see \asbamboo\security\user\provider\UserProviderInterface::loadByLoginName()
     */
    public function loadByLoginName(string $login_name) : ? UserInterface
    {
        $criteria   = [
            'user_id' => $login_name,
        ];
        $Db         = $this->Container->get(Constant::KERNEL_DB);
        $Manager    = $Db->getManager();
        return $Manager->getRepository(UserEntity::class)->findOneBy($criteria);
    }
}