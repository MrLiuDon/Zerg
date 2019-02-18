<?php

namespace app\api\model;

class Banner extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];
	public function items()
	{
		return $this->hasMany('BannerItem','banner_id','id');
	}

	public static function getBannerById($id)
	{
        $banner = self::with(['items','items.img'])->find($id);
//		$result = Db::table('banner_item')->where('banner_id','=',$id)->select();
//		return $result;
        $stu = array("name"=>"li","age"=>"35");
        $stuJson = json_encode($stu);
        echo $stuJson;
//输出：{"name":"li","age":"35"}

//json用json_decode转为php对象
        $stu1 = json_decode($stuJson);
        echo $stu1->name;
//输出li
       return $banner;
	}
}