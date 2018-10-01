<?php
namespace asbamboo\frameworkDemo\api\traits;

use asbamboo\api\apiStore\ApiRequestParamsInterface;
use asbamboo\frameworkDemo\model\user\UserEntity;

/**
 * 或者api接口请求者信息
 *  - 使用这个trait的类需要配置 $db属性（asbamboo\database\FactoryInterface）
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
trait GetApiUserTrait
{
    /**
     *
     * @param ApiRequestParamsInterface $Params
     * @return UserEntity|NULL
     */
    public function getUser(ApiRequestParamsInterface $Params) : ?UserEntity
    {
        $user_id        = $Params->getAppKey();
        $User           = $this->Db->getManager()->getRepository(UserEntity::class)->findOneBy(['user_id' => $user_id ]);
        return $User;
    }
}