<?php
/**
 * 数据库备份迁移管理插件
 * DatabaseManagePlugs
 * 1.0安装脚本
 * User: ChrisQx
 * Date: 2020/12/08
 * Time: 22:54
 */

// 创建表结构
// 更改表结构
// 添加数据
// 移动view文件 都可以
\EasySwoole\Utility\File::copyFile(EASYSWOOLE_ROOT."/vendor/chrisplugs/database-manage/src/view/index.html",EASYSWOOLE_ROOT."/public/nepadmin/views/chrisplugs/database-manage/index.html");