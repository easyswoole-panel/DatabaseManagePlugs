<?php
/**
 * 插件初始化 只要引入composer 每次ES运行都会初始化
 * User: Siam
 * Date: 2020/12/1 0001
 * Time: 22:55
 */
namespace Chrisplugs\DatabaseManage;
use Chrisplugs\DatabaseManage\controller\BackupController;
use Siam\Plugs\common\PlugsRouterHelper;


class PlugsInitialization
{
    /**
     * 初始化 提供插件管理的api
     * @api /api/chris_plugs/db_manage/get_logs
     * @api /api/chris_plugs/db_manage/back_up
     */
    public static function initPlugsRouter()
    {
        PlugsRouterHelper::getInstance()->addAnyRouter([
            '/api/chris_plugs/db_manage/get_logs' => [new BackupController, 'get_logs'],
            '/api/chris_plugs/db_manage/back_up' => [new BackupController, 'back_up'],
        ]);

    }
}
PlugsInitialization::initPlugsRouter();