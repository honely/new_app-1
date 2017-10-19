<?php
/**
 * 登录controller.
 * User: Pengfan
 * Date: 2017/10/13
 * Time: 14:58
 */
namespace app\Admin\controller;
use app\Admin\model\Qqinfo;
use app\Admin\model\User;
use Org\QQ;
use think\Cache;
use think\Controller;
use think\Request;

class Login extends Controller
{


    /**
     * qq三方登录参数
     */
    private $qq_param = [
        //APP ID
        'app_id' => "",
        //APP Key
        'app_key' => "",
        //回调地址
        'callBackUrl' => ""
    ];

    /**
     * 会员账号登录
     */
    public function login(){
        $param = Request::instance()->post();
        if(empty($param)){
            return json(['code' => 0,'msg' => '参数为空！']);
        }
        $user_model = new User();
        $get_user_info = $user_model->get_user_info($param);
        $uid = $get_user_info['data']['uid'];
        $token = _produce_token($uid);
        Cache::set('token',$token);
        return json($get_user_info);
    }


    /**
     * 会员注册
     */
    public function register(){
        $param = Request::instance()->post();
        if(empty($param)){
            return json(['code' => 0,'msg' => '数据错误！']);
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $rand_str = _rand_str(6);
        $user_model = new User();
        $add_user_info = $user_model->add_user_info($param,$rand_str,$ip);
        return json($add_user_info);
    }


    /**
     * 修改密码
     */
    public function update_pw(){
        $param = Request::instance()->post();
        $uid = $param['uid'];
        $token = $param['token'];
        $new_pw = $param['new_pw'];
        if(!_check_token($uid,$token)){
            return json(['code' => -3,'msg' => '身份验证失败，请重新登录！']);
        }
        $user_model = new User();
        $update_pw = $user_model->update_pw($uid,$new_pw);
        return $update_pw ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 修改绑定手机号
     */
    public function update_mobile(){
        $param = Request::instance()->post();
        $uid = $param['uid'];
        $token = $param['token'];
        $new_mobile = $param['new_mobile'];
        if(!_check_token($uid,$token)){
            return json(['code' => -3,'msg' => '身份验证失败，请重新登录！']);
        }
        $user_model = new User();
        $upate_mobile = $user_model->update_mobile($uid,$new_mobile);
        return $upate_mobile ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 修改头像
     */
    public function update_head_img(){
        $param = Request::instance()->post();
        $uid = $param['uid'];
        $token = $param['token'];
        if(!_check_token($uid,$token)){
            return json(['code' => -3,'msg' => '身份验证失败，请重新登录！']);
        }
        $user_model = new User();
        $route = "headImg/";
        $img_url = upload_img('head_img',1024*1024,$route,0);
        $update_head_img = $user_model->update_head_img($img_url,$uid);
        return $update_head_img ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 发送手机验证码
     */
    public function send_sms_code(){
        header('Content-Type: text/plain; charset=utf-8');
        $param = Request::instance()->post();
        $uid = $param['uid'];
        $token = $param['token'];
        $mobile = $param['mobile'];
        if(!_check_token($uid,$token)){
            return json(['code' => -3,'msg' => '身份验证失败，请重新登录！']);
        }
        $accessKeyId = "LTAIz4qwld4JhGBD";
        $accessKeySecret = "W5GI4y9px8VQrvzc2NiJaOn0E7bPAt";
        $signName = "彭耀久";
        $templateCode = "SMS_94605099";
        $phoneNumbers = $mobile;
        $send_class = new \SmsDemo($accessKeyId,$accessKeySecret);
        $code = _rand_str(4);
        Cache::set('mobile_code',$code);
        $send_code = $send_class->sendSms(
            $signName,
            $templateCode,
            $phoneNumbers,
            ['number' => $code]
        );
        $send_data = json_encode($send_code);
        if($send_data->Code == 'ok'){
            return json(['code' => 1,'msg' => '发送成功！']);
        }else{
            return json(['code' => -1,'msg' => $send_data->Message]);
        }
    }


    /**
     * qq三方登录
     */
    public function qq_login(){
        $app_id = $this->qq_param['app_id'];
        $app_key = $this->qq_param['app_key'];
        $callBach_url = $this->qq_param['callBackUrl'];
        $qq_class = new QQ($app_id,$app_key,$callBach_url);
        $qq_class->getAuthCode();
    }


    /**
     * qq回调
     */
    public function callback(){
        $app_id = $this->qq_param['app_id'];
        $app_key = $this->qq_param['app_key'];
        $callBach_url = $this->qq_param['callBackUrl'];
        $Qqconnect = new QQ($app_id,$app_key,$callBach_url);
        $openid = $Qqconnect->getOpenId();
        $qq = session('qq');
        $map = array();
        $qq_model = new Qqinfo();
        $userInfo = $qq_model->get_qq_info($openid);
        if(!empty($userInfo)){
            return json(['code' => 1,'msg' => '登录成功！']);
        }



    }







}