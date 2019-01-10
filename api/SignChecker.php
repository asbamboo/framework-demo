<?php
namespace asbamboo\frameworkDemo\api;

use asbamboo\api\apiStore\validator\SignCheckerAbstract;
use asbamboo\http\ServerRequestInterface;
use asbamboo\database\FactoryInterface;
use asbamboo\frameworkDemo\model\user\UserEntity;
use asbamboo\frameworkDemo\api\exception\core\InvalidAppKeyException;

/**
 * 签名验证器
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年10月1日
 */
class SignChecker extends SignCheckerAbstract
{
    /**
     *
     * @var FactoryInterface
     */
    private $Db;

    /**
     *
     * @param ServerRequestInterface $Request
     * @param string $input_app_key
     * @param string $input_sign
     * @param FactoryInterface $Db
     */
    public function __construct(ServerRequestInterface $Request, string $input_app_key = 'app_key', string $input_sign = 'sign', FactoryInterface $Db)
    {
        parent::__construct($Request, $input_app_key, $input_sign);

        $this->Db           = $Db;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\api\apiStore\validator\SignCheckerAbstract::getAppSecurity()
     */
    public function getAppSecurity(): string
    {
        /**
         *
         * @var UserEntity $User
         */
       $app_key = $this->Request->getRequestParam($this->input_app_key);
       $User    = $this->Db->getManager()->getRepository(UserEntity::class)->findOneBy(['user_id' => $app_key]);
       if(empty($User) || empty($User->getUserSecurity())){
            throw new InvalidAppKeyException('无效的 app_key.');
       }
       return $User->getUserSecurity();
    }
}
