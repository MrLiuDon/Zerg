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
        return $banner;
	}
}