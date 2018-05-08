<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/27
 * Time: 16:23
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}