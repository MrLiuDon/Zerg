<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/12
 * Time: 22:19
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden = ['topic_img_id','head_img_id','delete_time','update_time'];

    public function topicImg()
    {
        return $this->belongsTo('image','topic_img_id','id');
    }

    public function headImg()
    {
        return $this->belongsTo('image','head_img_id','id');
    }

    public function products()
    {
        return $this->belongsToMany('Product','theme_product',
            'product_id','theme_id');
    }

    public static function getThemeWithProducts($id)
    {
        $theme = self::with('products,topicImg,headImg')->find($id);
        return $theme;
    }
}