<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/17
 * Time: 21:08
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 400;
    public $msg = '指定的商品不存在，请检查参数';
    public $errorCode = 20000;
}