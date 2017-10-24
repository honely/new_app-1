<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * token 验证
 * @param $uid 用户uid $token 用户token
 * @return true or false;
 */
function _check_token($uid,$token){
    $token_key = config('token_key');
    $vali_token = substr(md5(md5($uid).$token_key),0,10);
    if($token == $vali_token){
        return true;
    }else{
        return false;
    }
}


/**
 * 生成随机数
 * @param $len 长度;
 * @return string or null;
 */
function _rand_str($len){
    $str = "123456789abcdefghijkmnpqrstuvwxyz";
    $str_code = "";
    for($i = 0; $i < $len; $i++){
        $str_code .= $str[mt_rand(0,strlen($str))];
    }
    return $str_code ? $str_code : null;
}

/**
 * 生成token
 * @param $uid 会员uid $token_key token链接字符
 * @return string
 */
function _produce_token($uid){
    $token_key = config('token_key');
    $token_str = substr(md5(md5($uid).$token_key),0,10);
    return $token_str;
}


/**
 * 上传文件(包含图片，视频，音频)
 * @param $name name名称  $maxsize 文件最大值 $route 文件路径  $type 文件类型
 * @return array  or  string;
 */
function upload_img($name,$maxsize,$route,$type = 0){
    switch ($type){
        case 0:
            $arr = ['jpg','jpeg','png','gif'];
            break;
        case 1:
            $arr = ['mp3','ogg'];
            break;
        case 2:
            $arr = ['rmvb'];
            break;
    }
    if(is_array($_FILES[$name]['name'])){
        $nameArr = $_FILES[$name]['name'];
        $objArr = $_FILES[$name]['tmp_name'];
        $sizeArr = $_FILES[$name]['size'];
        $arr_return = [];
        for($i = 0; $i < count($nameArr); $i++){
            if(!$nameArr[$i]){
                continue;
            }
            $_arr = explode('.',$nameArr[$i]);
            $lastTime = end($_arr);
            if(in_array($lastTime,$arr) && $sizeArr[$i] <= $maxsize){
                $savrName = $route.uniqid().'.'.$lastTime;
                move_uploaded_file($objArr[$i],$savrName);
                array_push($arr_return,$savrName);
            }
        }
        return $arr_return;
    }else{
        $_name = $_FILES[$name]['name'];
        $_size = $_FILES[$name]['size'];
        $_obj = $_FILES[$name]['tmp_name'];
        $_arrName = explode('.',$_name);
        $_lastName = end($_arrName);
        $_savrName = "";
        if(in_array($_lastName,$arr) && $_size <= $maxsize){
            $_savrName = $route.uniqid().'.'.$_lastName;
            move_uploaded_file($_obj,$_savrName);
        }
        return $_savrName;

    }


}


/**
 * 权限匹配
 */
function _mate_power($power_str){
    if(!login_over_time()){
        return false;
    }
    $session_data = \think\Cache::get('admin_data')[0]['power'];
    if(!empty($session_data)){
        $session_data = explode(',',$session_data);
    }else{
        return false;
    }
    if(in_array($power_str,$session_data)){
        return true;
    }else{
        return false;
    }
}


/**
 * 读取权限文件
 */
function _add_power(){
    $file_path = "power/power.txt";
    if(file_exists($file_path)){
        $str = file_get_contents($file_path);
        $array = explode("#", $str);
        for($i = 0; $i < count($array); $i++)
        {
            if(!empty($array[$i])){
                $arr[] = trim($array[$i],"");
            }
        }
        return $arr;
    }
}


/**
 * 登录超时
 */
function login_over_time(){
    $session_data = \think\Cache::get('admin_data');
    if($session_data){
        return true;
    }else{
        return false;
    }
}


