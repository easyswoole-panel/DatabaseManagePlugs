<?php
/**
 * 数据库备份迁移管理插件
 * DatabaseManagePlugs
 * 1.0安装脚本
 * User: ChrisQx
 * Date: 2020/12/09
 * Time: 22:54
 */
namespace Chrisplugs\DatabaseManage\database;
use Siam\Plugs\common\PlugsHelper;

class install
{
    public function run()
    {
        //初始化备份记录表　sima_database_backup_logs
        return true;
    }
}
(new install())->run();
