<?php
/**
 * Created by PhpStorm.
 * User: liuyongdong
 * Date: 2018/6/10
 * Time: 15:00
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\TestTable;
use function MongoDB\BSON\toJSON;
use think\console\command\make\Model;


class Test extends BaseController
{
    public function GetWxInfo($str)
    {

        toJSON('aaa');
        $speModel = new TestTable();
        //$speModel->execute("insert into  testTable  (testkey) VALUES ('001')");
        $speModel->execute("update testTable set testkey='$str' ");
    }
}