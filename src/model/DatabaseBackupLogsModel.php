<?php
/**
 * Created by : PhpStorm
 * User: Chris青玄
 * Date: 2020/12/22
 * Time: 10:25 下午
 */

namespace Chrisplugs\DatabaseManage\model;

use EasySwoole\ORM\Exception\Exception;

/**
 * 备份记录表模型
 * Class DatabaseBackupLogsModel
 * @package DatabaseManage\model
 */
class DatabaseBackupLogsModel extends BaseModel
{

    protected $tableName = 'database_backup_logs';
    protected $autoTimeStamp = true;
    protected $createTime = 'backup_at';
    protected $updateTime = 'backup_at';

    /**
     * 获取备份记录
     * @return array
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     */
    public function get_logs()
    {
        $list =  $this->withTotalCount()->all();
        $total = $this->lastQueryResult()->getTotalCount();
        return [
            'list'=>$list,
            'total'=>$total
        ];
    }

    /**
     * 添加备份记录
     * @param array $path
     * @return bool|string
     * @throws \Throwable
     */
    public function add_logs(array $path)
    {
        $tmpFile = $path['dirPath'].'/'.$path['fileName'];
        //避免空文件
        $size = filesize($tmpFile);
        if ($size<100){
           throw new \Exception('文件校验失败');
        }
        try {
            $model = $this->create([
                'name' => $path['fileName']
            ]);
            $model->save();
        } catch (Exception $e) {
            //如果写入记录失败，文件要删除，保持一致
            unlink($tmpFile);
            return $e->getMessage();
        }
            return true;
    }

}