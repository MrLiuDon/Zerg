<?php
/**
 * Created by 二虎哥哥.
 * Author: 二虎哥哥
 * QQ: 505120790
 * Date: 2017/5/19
 * Time: 23:56
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if ($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult){
        // 拿到openid
        // 数据库里检查openid是否存在
        // 如果不存在则新添一条记录
        // 生成令牌，缓存数据
        // 把令牌返回到客户端
        // key: 令牌
        // value: wxResult,uid,scope
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if ($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult,$uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    private function saveToCache($cachedValue){
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = config('setting.token_expire_in');  //缓存过期时间

        $request = cache($key,$value,$expire_in);
        if(!$request){
            throw new TokenException(
                [
                    'msg' => '服务器缓存异常',
                    'errorCode' => 10005
                ]
            );
        }
        return $key;
    }

    private function prepareCachedValue($wxResult,$uid){
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User; //代表App用户权限数值
        return $cachedValue;
    }

    private function newUser($openid){
        $user = UserModel::create(
            [
                'openid' => $openid
            ]
        );
        return $user->id;
    }

    private function processLoginError($wxResult){
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'errorcode' => $wxResult['errcode']
            ]
        );
    }
}