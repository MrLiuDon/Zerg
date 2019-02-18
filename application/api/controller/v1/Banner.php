<?php

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;

class Banner{
	/**
	 * 获取指定id的banner信息
	 * @url /banner/:id
	 * @http GET
	 * @id  banner的id号
	 *
	 */
    public function getBanner($id)
    {
        $stu = array("name"=>"li","age"=>"35");
        $stuJson = json_encode($stu);
        echo $stuJson;
//输出：{"name":"li","age":"35"}

//json用json_decode转为php对象
        $stu1 = json_decode($stuJson);
        echo $stu1->name;
//输出li
        (new IDMustBePostiveInt())->goCheck();
        $banner = BannerModel::getBannerById($id);
//        $banner->hidden(['update_time']);
        if (!$banner) {
            throw new BannerMissException();
        }
        return $banner;
    }
}