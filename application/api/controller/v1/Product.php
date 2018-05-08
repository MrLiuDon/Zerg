<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/17
 * Time: 20:33
 */

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;

use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;

class Product
{
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if($products->isEmpty()){
            throw new ProductException();
        }
//        $collection = collection($products);
        $products = $products->hidden(['summary']);
        return $products;
    }

    public function getAllProductInCategory($id){
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }

    public function getOne($id){
        (new IDMustBePostiveInt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }
        return $product;
    }

    public function deleteOne($id){
        ProductModel::destroy($id);
    }
}