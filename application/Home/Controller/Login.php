<?php
/**
 * 后台管理controller.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:18
 */
namespace app\Home\controller;
use app\Home\model\Admin;
use think\Cache;
use think\Controller;
use think\Request;

class Login extends Controller
{

    /**
     * 管理员登录
     */
    public function Index(){
        $param = Request::instance()->post();
        if($param){
            $user_name = $param['user_name'];
            $pass_word = $param['pass_word'];
            if(empty($user_name) || empty($pass_word)){
                $this->error('新增失败');
            }
            $admin_model = new Admin();
            $get_user_info = $admin_model->login($user_name,$pass_word);
            Cache::set('admin_data',$get_user_info,3600);
            return $get_user_info ? json(['code' => 1,'msg' => '登录成功！']) : json(['code' => -1,'msg' => '登录失败！']);
        }
        return $this->fetch('index');
    }


    /**
     * 添加管理员
     */
    public function Add_admin_user(){
        if(!login_over_time()){
            return json(['code' => 0,'msg' => '账号在线超时！']);
        }
        $admin_model = new Admin();
        $param = Request::instance()->post();
        $user_name = $param['user_name'];
        $pass_word = $param['pass_eord'];
        if(empty($user_name) || empty($pass_word)){
            return json(['code' => -1,'msg' => '账号或密码不能为空！']);
        }
        $add_user = $admin_model->add_user($user_name,$pass_word);
        return $add_user ? json(['code' => 1,'msg' => '添加成功！']) : json(['code' => -2,'msg' => '添加失败！']);
    }


    /**
     * 添加权限
     */
    public function Add_user_power(){
        $power_str = "tianjiaquanxian";
        if(!login_over_time()){
            return json(['code' => 0,'msg' => '账号在线超时！']);
        }
        if(!_mate_power($power_str)){
            return json(['code' => -1,'msg' => '你没有权限进行该操作！']);
        }


    }




}