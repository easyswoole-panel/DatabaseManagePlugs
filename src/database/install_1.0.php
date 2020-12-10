<?php
/**
 * 数据库备份迁移管理插件
 * DatabaseManagePlugs
 * version 1.0
 * User: ChrisQx
 * Date: 2020/12/09
 * Time: 22:54
 */
namespace DatabaseManage\database;
use DatabaseManage\common\Helper;
use EasySwoole\EasySwoole\Config;
use Siam\Plugs\common\PlugsHelper;
use EasySwoole\DDL\Blueprint\Table;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

/**
 * 安装脚本
 * Class Install
 * @package DatabaseManage\database
 */
class Install
{

    /**
     * 日志表
     * @var string database_backup_logs
     */
    private $logTable;



    /**
     * 安装流程
     * @return bool
     */
    public function install()
    {
        //检查前缀
        $prefix = Config::getInstance()->getConf('MYSQL.prefix');
        //设定表名
        $this->logTable  = "{$prefix}database_backup_logs";
        //助手类
        $Helper = Helper::getInstance();
        //检查是否存在表，不存在则创建,使用默认连接
        $checkTable = $Helper->checkTable($this->logTable);
            if (!$checkTable){
                $create = $this->createlogTable();
                if (!$create){
                    return false;
                }
            }
        return true;
    }

    /**
     * 创建日志表
     * @param string $connection 指定的数据库连接
     * @return mixed
     */
    protected function createlogTable($connection='default')
    {
        //创建表DDL
        $sql = DDLBuilder::table("{$this->logTable}",function (Table $table){
            $table->setTableComment('数据库备份记录表')
                ->setTableEngine(Engine::MYISAM)
                ->setTableCharset(Character::UTF8MB4_GENERAL_CI);
            $table->colInt('id',10)->setColumnComment('ID')->setIsAutoIncrement()->setIsPrimaryKey();
            $table->colVarChar('name',50)->setColumnComment('备份文件名')->setIsNotNull();
            $table->colInt('backup_at',10)->setIsNotNull()->setColumnComment('创建时间');
        });

        $queryBuild = new QueryBuilder();
        $queryBuild->raw($sql);
        return DbManager::getInstance()->query($queryBuild, true, $connection)->getResult();

    }
}
//go install
(new Install())->install();
