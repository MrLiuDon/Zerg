<?php

namespace app\api\behavior;

class CORS{
	public function appInit(&$params)
    {
        header('Access-Control-Allow-Origin: *');  //允许所有域访问API
        //允许header携带的键值对
        header("Access-Control-Allow-Headers: token, Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }
}