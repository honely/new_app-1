<?php
/**
 * 后台首页controller.
 * User: Pengfan
 * Date: 2017/10/19
 * Time: 14:02
 */
namespace app\Home\controller;
use think\Controller;

class Index extends Controller
{

    public function index(){
        $power_str = "shouye";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            return json(['code' => -1,'msg' => '你没有权限查看该功能！']);
        }
        return $this->fetch('index');
    }

}
