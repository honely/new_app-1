<?php
/**
 * 平台会员controller.
 * User: Pengfan
 * Date: 2017/10/26
 * Time: 12:02
 */
namespace app\Home\controller;
use app\Home\model\Userp;
use think\Controller;
use think\Db;
use think\Request;

class User extends Controller
{

    /**
     * 平台会员添加
     */
    public function Add_plat_user(){
        $power_str = "tijianpingtaihuiyuan";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行该操作！','home/index/index');
        }
        $user_model = new Userp();
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $rand_str = _rand_str(6);
            $select_res = Db::table('e_user')->where(['user_name' => $param['user_name']])->select();
            if($select_res){
                return json(['code' => -2,'msg' => '该昵称已被注册！']);
            }
            $add_plat_user = $user_model->add_plat_user($param,$rand_str);
            return $add_plat_user ? json(['code' => -1,'msg' => '添加成功！']) : json(['code' => -1,'msg' => '添加失败！']);
        }
        return $this->fetch('index');

    }

}