<?php
namespace asbamboo\frameworkDemo;

use asbamboo\framework\kernel\HttpKernel as BaseHttpKernel;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月24日
 */
class HttpKernel extends BaseHttpKernel
{
    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\framework\kernel\HttpKernel::getProjectDir()
     */
    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\framework\kernel\HttpKernel::getConfigPath()
     */
    public function getConfigPath() : string
    {
        return __DIR__ . '/config/config.php' ;
    }
}