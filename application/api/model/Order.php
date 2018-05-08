<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/6/1
 * Time: 20:24
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;   //自动返回当前时间戳

    public function getSnapItemsAttr($value){
        if (empty($value)){
            return null;
        }
        return json_decode($value);
    }

    public function getSnapAddressAttr($value){
        if (empty($value)){
            return null;
        }
        return json_decode($value);
    }

    public static function getSummaryByUser($uid,$page=1,$size=15){
        $pagingData = self::where('user_id','=',$uid)
            ->order('create_time','desc')
            ->paginate($size,true,['page'=>$page]);
        return $pagingData;
    }

    public static function getSummaryByPage($page=1, $size=20){
        $pagingData = self::order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData ;
    }
}