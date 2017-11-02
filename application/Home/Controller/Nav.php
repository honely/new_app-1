<?php
/**
 * 分类导航controller.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 14:46
 */
namespace app\Home\controller;
use app\Home\model\Navsort;
use think\Controller;
use think\Request;

class Nav extends Controller
{


    /**
     * 分类导航信息
     */
    public function Index(){
        $power_str = "daohangliebiao";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        $get_nav_list = $nav_model->get_sort_nav_info();
        $this->assign('nav_data',$get_nav_list);
        return $this->fetch('index');

    }


    /**
     * 添加导航
     */
    public function Add_nav(){
        $power_str = "tianjiadaohang";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $add_new_nav = $nav_model->add_new_nav($param);
            return $add_new_nav ? json(['code' => 1,'msg' => '添加成功！']) : json(['code' => -1,'msg' => '添加失败！']);
        }
        return $this->fetch('add_nav');


    }


    /**
     * 修改导航状态
     */
    public function Update_nav_status(){
        $power_str = "xiugaidaohangzhuangtai";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        $nav_id = input('id');
        $status = input('status');
        $update_nav_status = $nav_model->update_nav_status($nav_id,$status);
        return $update_nav_status ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 修改导航信息
     */
    public function Update_nav_info(){
        $power_str = "xiugaidaohangxinxi";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        if(Request::instance()->post()){
            $param = Request::instance()->post();
            $update_nav = $nav_model->update_nav_info($param);
            return $update_nav ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);
        }
        return $this->fetch('update_nav');


    }


    /**
     * 分类导航banner
     */
    public function Get_nav_banner(){
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        $nav_model = new Navsort();
        $page = input('page');
        if(isset($page) && $page !== null){
            $current = $page;
        }else{
            $current = 1;
        }
        $options = [
            'page' => $current,
            'url' => url('get_nav_banner')
        ];
        $get_nav_banner = $nav_model->get_nav_banner($options);
        $this->assign('data',$get_nav_banner['data']);
        $this->assign('page',$get_nav_banner['page']);
        return $this->fetch('nav_banner');

    }


    /**
     * 修改banner状态
     */
    public function Update_banner_status(){
        $power_str = "xiugaibannerzhuangtai";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        $banner_id = input('id');
        $status = input('status');
        $update_status = $nav_model->update_banner_status($banner_id,$status);
        return $update_status ? json(['code' => 1,'msg' =>'修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 修改导航banner信息
     */
    public function Update_banner_info(){
        $power_str = "xiugainavbannerxinxi";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        $banner_id =  input('banner_id');
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $update_banner_info = $nav_model->update_banner_info($param);
            return $update_banner_info ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);
        }
        $get_nav_banner = $nav_model->get_nav_banner_info($banner_id);
        $this->assign('banner_data',$get_nav_banner);
        return $this->fetch('banner_details');
    }


    /**
     * 添加导航banner
     */
    public function Add_nav_banner(){
        $power_str = "tianjianavbanner";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $nav_model = new Navsort();
        $get_nav_list = $nav_model->get_sort_nav_info();
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $add_nav_banner = $nav_model->add_nav_banner($param);
            return $add_nav_banner ? json(['code' => 1,'msg' => '添加成功！']) : json(['code' => -1,'msg' =>'添加失败！']);
        }
        $this->assign('nav_data',$get_nav_list);
        return $this->fetch('add_nav_banner');

    }




}