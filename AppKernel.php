<?php
namespace asbamboo\frameworkDemo;

use asbamboo\framework\kernel\KernelAbstract;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月24日
 */
class AppKernel extends KernelAbstract
{
    /**
     *
     * {@inheritDoc}
     * @see KernelAbstract::getProjectDir()
     */
    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     *
     * {@inheritDoc}
     * @see KernelAbstract::getConfigPath()
     */
    public function getConfigPath() : string
    {
        return __DIR__ . '/config/config.php' ;
    }
}