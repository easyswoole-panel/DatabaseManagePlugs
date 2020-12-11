<?php
/**
 * Created by : PhpStorm
 * User: Chris青玄
 * Date: 2020/12/9
 * Time: 11:49 下午
 */
namespace DatabaseManage\common;
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
     * 检查插件所需表是否满足
     * @param string $tableName
     * @return mixed
     */
    public function checkTable(string $tableName)
    {
        if(!$tableName){
            return false;
        }
        $TableSql = "SHOW TABLES LIKE '{$tableName}'";
        $queryBuild = new QueryBuilder();
        $queryBuild->raw($TableSql);
        return DbManager::getInstance()->query($queryBuild, true, 'default')->getResult();
    }

}
