<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/6/3
 * Time: 20:33
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id=''){
        (new IDMustBePostiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    public function receiveNotify(){
        //通知频率为15/15/30/180/1800/1800/1800/3600,单位:秒

        //1.检查库存量,超卖
        //2.更新这个订单的status状态
        //3.减库存
        //如果成功处理，返回微信成功处理信息,否则返回未成功处理信息
        //特点：post,xml格式,不会携带参数
        $notify = new WxNotify();
        $notify->Handle();

        //$xmlData = file_get_contents('php://input');
        //$result = curl_post_raw('http:/z.cn/api/v1/pay/re_notify?XDEBUG_SESSION_START=13133',
        //$xmlData);
        //路由要配置一下
    }

    public function redirectNotify(){
        $notify = new WxNotify();
        $notify->Handle();
    }
}