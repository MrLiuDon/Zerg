<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/17
 * Time: 22:02
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }
}