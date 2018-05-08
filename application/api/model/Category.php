<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/17
 * Time: 22:03
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = ['create_time','delete_time','update_time'];

    public function img()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}