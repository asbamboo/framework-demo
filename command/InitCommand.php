<?php
namespace asbamboo\frameworkDemo\command;

use asbamboo\console\ProcessorInterface;
use asbamboo\console\command\CommandAbstract;
use asbamboo\di\ContainerAwareTrait;
use asbamboo\framework\Constant;
use asbamboo\database\ManagerInterface;
use asbamboo\database\FactoryInterface;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月17日
 */
class InitCommand extends CommandAbstract
{
    use ContainerAwareTrait;

    /**
     *
     * @var ManagerInterface
     */
    private $DbManager;

    /**
     *
     * @param FactoryInterface $Db
     */
    public function __construct(FactoryInterface $Db)
    {
        parent::__construct();
        $this->DbManager   = $Db->getManager();
    }

    /**
     * 删除数据信息
     *
     * @param ProcessorInterface $Processor
     */
    private function dropDbData(ProcessorInterface $Processor) : void
    {
        /**
         *
         * @var Factory $Db
         */
        $this->DbManager->getConnection()->exec("
            DROP TABLE IF EXISTS `t_user`;
        ");
        $this->DbManager->getConnection()->exec("
            DROP TABLE IF EXISTS `t_post`;
        ");
    }

    /**
     * 创建初始数据表
     *
     * @param ProcessorInterface $Processor
     */
    private function createDbData(ProcessorInterface $Processor) : void
    {
        /**
         *
         * @var Factory $Db
         */
        $this->DbManager->getConnection()->exec("
            CREATE TABLE `t_user`(`user_seq` INTEGER PRIMARY KEY, `user_id`, `user_password`, `user_type`);
        ");
        $this->DbManager->getConnection()->exec("
            CREATE TABLE `t_post`(`post_seq` INTEGER PRIMARY KEY, `post_title`, `post_content`, `user_seq`, `post_create_time`, `post_update_time`);
        ");
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::exec()
     */
    public function exec(ProcessorInterface $Processor)
    {
        if($Processor->input()->prompt('初始化将导致以后数据被清除，你确定要初始化系统吗?请回复yes或no: ') == 'yes'){
            $Processor->output()->print('正在删除原有数据信息...', "\r\n");
            $this->dropDbData($Processor);
            $Processor->output()->print('正在重新创建初始数据信息...', "\r\n");
            $this->createDbData($Processor);
            $Processor->output()->print('系统初始化成功.', "\r\n");
        }
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::help()
     */
    public function help(): string
    {
        $console    = $_SERVER['SCRIPT_FILENAME'];

        return <<<HELP
    例: php {$console} {$this->getName()}

HELP;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::desc()
     */
    public function desc(): string
    {
        return '系统初始化';
    }

    /**
     * 定义命令行名称
     *
     * @return string
     */
    public function getName() : string
    {
        return 'asbamboo:framework-demo:init';
    }
}