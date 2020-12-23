<?php
/**
 * Created by : PhpStorm
 * User: Chris青玄
 * Date: 2020/12/22
 * Time: 10:50 下午
 */
namespace Chrisplugs\DatabaseManage\controller;
use Chrisplugs\DatabaseManage\model\DatabaseBackupLogsModel;
use EasySwoole\EasySwoole\Config;
use Siam\Plugs\common\PlugsBackupHelper;


class BackupController extends BaseController
{
    /**
     * 获取记录
     * @return bool
     */
    public function get_logs()
    {
        //获取记录
        $LogsModel = new DatabaseBackupLogsModel();
        $list = $LogsModel->get_logs();
        return $this->writeJson(0, $list);

    }

    /**
     * 备份
     * @return bool
     * @throws \Exception
     */
    public function back_up()
    {
        $fileName = date('YmdHis').'_backup.sql';
        $_host =  Config::getInstance()->getConf('MYSQL.host');
        $_user =  Config::getInstance()->getConf('MYSQL.user');
        $_pwd =  Config::getInstance()->getConf('MYSQL.password');
        $_database =  Config::getInstance()->getConf('MYSQL.database');


        $path = PlugsBackupHelper::getInstance()->create('chrisplugs/databasemanage',$fileName);
        $tmpFile = $path['dirPath'].'/'.$path['fileName'];
        // 用MySQLDump命令导出数据库
        $cmd = "mysqldump -h$_host -u$_user -p$_pwd --default-character-set=utf8 $_database > ".$tmpFile;
        exec($cmd);
        $LogsModel = new DatabaseBackupLogsModel();
        $res = $LogsModel->add_logs($path);
        if($res === true){
            return $this->writeJson(200, $path,'备份成功');
        }else{
            return $this->writeJson(200, $res,'备份失败');
        }

    }
}