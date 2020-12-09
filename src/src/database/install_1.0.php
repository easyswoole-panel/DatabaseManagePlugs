<?php
/**
 * 数据库备份迁移管理插件
 * DatabaseManagePlugs
 * 1.0安装脚本
 * User: ChrisQx
 * Date: 2020/12/09
 * Time: 22:54
 */
namespace DatabaseManage\database;
use Siam\Plugs\common\PlugsHelper;
use DatabaseManage\controller\Install;
function run()
{
    Install::getInstance()->install();
}
run();
