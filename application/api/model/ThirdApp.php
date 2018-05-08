<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/6/18
 * Time: 18:10
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }
}