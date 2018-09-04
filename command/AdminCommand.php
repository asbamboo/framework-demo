<?php
namespace asbamboo\frameworkDemo\command;

use asbamboo\console\ProcessorInterface;
use asbamboo\console\command\CommandAbstract;
use asbamboo\di\ContainerAwareTrait;
use asbamboo\framework\Constant;
use asbamboo\database\Factory;
use asbamboo\frameworkDemo\model\user\UserEntity;
use asbamboo\frameworkDemo\model\user\Constant AS UserConstant;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月17日
 */
class AdminCommand extends CommandAbstract
{
    use ContainerAwareTrait;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->AddOption('list', null, '列出所有管理员账号', 'l');
        $this->AddOption('insert', null, '添加新的管理员账号', 'i');
    }

    /**
     * 列出所有管理员账号
     *
     * @param ProcessorInterface $Processor
     */
    private function lists(ProcessorInterface $Processor) : void
    {
        /**
         *
         * @var Factory $Db
         */
        $Db             = $this->Container->get(Constant::KERNEL_DB);
        $DbManager      = $Db->getManager();
        $UserEntitys    = $DbManager->getRepository(UserEntity::class)->findBy(['user_type' => UserConstant::TYPE_ADMIN]);
        foreach($UserEntitys AS $UserEntity){
            $Processor->output()->print($UserEntity->getUserId(), "\t");
        }
    }

    /**
     * 创建新的管理员账号
     *
     * @param ProcessorInterface $Processor
     */
    private function insert(ProcessorInterface $Processor) : void
    {
        /**
         * 用户输入参数
         */
        $user_id            = $Processor->input()->prompt('请输入管理员账号:');
        $user_password      = $Processor->input()->prompt('请输入管理员密码:');
        $confirm_password   = $Processor->input()->prompt('请确认管理员密码:');

        /**
         * 验证
         */
        check:
        if($user_password != $confirm_password){
            $Processor->output()->print('两次密码输入不一致,请重新确认。', "\r\n");
            $user_password      = $Processor->input()->prompt('请输入管理员密码:');
            $confirm_password   = $Processor->input()->prompt('请确认管理员密码:');
            goto check;
        }

        /**
         * 管理员实例
         *
         * @var \asbamboo\frameworkDemo\model\user\UserEntity $UserEntity
         */
        $UserEntity         = new UserEntity();
        $UserEntity->setUserId($user_id);
        $UserEntity->setUserPassword($confirm_password);
        $UserEntity->setUserType(UserConstant::TYPE_ADMIN);

        /**
         *
         * @var Factory $Db
         */
        $Db                 = $this->Container->get(Constant::KERNEL_DB);
        $DbManager          = $Db->getManager();
        $DbManager->persist($UserEntity);
        $DbManager->flush();
        $Processor->output()->print('管理员添加成功', "\r\n");
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::exec()
     */
    public function exec(ProcessorInterface $Processor)
    {
        if($this->getOptionValueByProcessor('list', $Processor)){
            return $this->lists($Processor);
        }
        if($this->getOptionValueByProcessor('insert', $Processor)){
            return $this->insert($Processor);
        }
        return $this->insert($Processor);
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::desc()
     */
    public function desc() : string
    {
        return '管理员账号管理';
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::help()
     */
    public function help() : string
    {
        $console    = $_SERVER['SCRIPT_FILENAME'];

        return <<<HELP
    注意:选项insert和list不能同时使用,如果命令行不带任何参数，则表示省略insert选项。
    例: 添加新的管理员账号
        php {$console} {$this->getName()} --insert
        php {$console} {$this->getName()}
    例: 管理员账号列表
        php {$console} {$this->getName()} --list

HELP;
    }

    /**
     * 定义命令行名称
     *
     * @return string
     */
    public function getName() : string
    {
       return 'asbamboo:framework-demo:admin';
    }
}
