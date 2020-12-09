<?php
/**
 * Created by : PhpStorm
 * User: Chris青玄
 * Date: 2020/12/9
 * Time: 11:49 下午
 */
namespace DatabaseManage\common;
use EasySwoole\DDL\Blueprint\Table;
use EasySwoole\DDL\DDLBuilder;
use EasySwoole\DDL\Enum\Character;
use EasySwoole\DDL\Enum\Engine;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;
use EasySwoole\Component\Singleton;

/**
 * 公共助手类
 * Class Helper
 * @package DatabaseManage\common
 */
class Helper
{
    use Singleton;

    /**
     * 检查日志表
     * @return mixed
     */
    public function checkTable()
    {
        $sql = "SHOW TABLES LIKE 'siam_database_backup_logs'";
        $queryBuild = new QueryBuilder();
        $queryBuild->raw($sql);
        return DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();
    }

    /**
     * 创建日志表
     * @param string $connection 指定的数据库连接
     * @return mixed
     */
    public function createTable($connection='default')
    {
        //创建表DDL
        $sql = DDLBuilder::table('siam_database_backup_logs',function (Table $table){
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
