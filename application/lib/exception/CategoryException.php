<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/17
 * Time: 22:20
 */

namespace app\lib\exception;


class CategoryException extends  BaseException
{
    public $code = 500;
    public $msg = '指定的类目不存在，请检查参数';
    public $errorCode = 50000;
}