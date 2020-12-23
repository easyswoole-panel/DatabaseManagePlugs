<?php
/**
 * 数据库备份迁移管理插件
 * DatabaseManagePlugs
 * version 1.0
 * User: ChrisQx
 * Date: 2020/12/09
 * Time: 22:54
 */
namespace Chrisplugs\DatabaseManage\database;
use Siam\Plugs\common\PlugsTableHelper;
use EasySwoole\DDL\Blueprint\Table;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use Siam\Plugs\common\PlugsMenuHelper;

/**
 * 安装脚本
 * Class Install
 * @package DatabaseManage\database
 */
class Install
{
    /**
     * 安装流程
     * @return bool
     */
    public function install()
    {
        //使用基础包提供的助手类建表
        PlugsTableHelper::getInstance()->create('database_backup_logs',function (Table $table){
            $table->setTableComment('数据库备份记录表')
                ->setTableEngine(Engine::MYISAM)
                ->setTableCharset(Character::UTF8MB4_GENERAL_CI);
            $table->colInt('id',10)->setColumnComment('ID')->setIsAutoIncrement()->setIsPrimaryKey();
            $table->colVarChar('name',50)->setColumnComment('备份文件名')->setIsNotNull();
            $table->colVarChar('path',255)->setColumnComment('文件路径')->setIsNotNull();
            $table->colInt('backup_at',10)->setIsNotNull()->setColumnComment('创建时间');
        });
        PlugsMenuHelper::getInstance()->add('数据库备份迁移管理插件','/chrisplugs/database-manage/index','layui-icon-piechart');
    }
}
//go install
(new Install())->install();
