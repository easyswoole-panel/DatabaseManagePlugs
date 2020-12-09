<?php
/**
 * Created by : PhpStorm
 * User: Chris青玄
 * Date: 2020/12/9
 * Time: 9:31 下午
 */
namespace DatabaseManage\controller;
use DatabaseManage\common\Helper;
use EasySwoole\Component\Singleton;

/**
 * 安装流程
 * Class Install
 * @package DatabaseManage\controller
 */
class Install extends BaseController
{
    use Singleton;
    /**
     * 控制流程
     * @return bool
     */
    public function install()
    {
        $Helper = Helper::getInstance();
        //检查是否存在表，不存在则创建
        $checkTable = $Helper->checkTable();
        if (!$checkTable){
            $create = $Helper->createTable();
            if($create === true){
                return true;
            }
        }
        return false;
    }

}