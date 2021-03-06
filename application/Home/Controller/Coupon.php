<?php
/**
 * 礼券controller.
 * User: Pengfan
 * Date: 2017/11/1
 * Time: 14:50
 */
namespace app\Home\controller;
use app\Home\model\Couponm;
use think\Controller;
use think\Db;
use think\Request;

class Coupon extends Controller
{

    /**
     * 礼券列表
     */
    public function Index(){
        $power_str = "liquanxinxi";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $coupon_model = new Couponm();
        $page = input('page');
        if(isset($page) && $page !== null){
            $current = $page;
        }else{
            $current = 1;
        }
        $options = [
            'page' => $current,
            'url' => url('index')
        ];
        $get_coupon_list = $coupon_model->get_coupon_info($options);
        $this->assign('data',$get_coupon_list['data']);
        $this->assign('page',$get_coupon_list['page']);
        return $this->fetch('index');

    }


    /**
     * 添加礼券
     */
    public function Add_coupon(){
        $power_str = "tianjialiquan";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/coupon/index');
        }
        if(Request::instance()->isPost()){
            $coupon_model = new Couponm();
            $param = Request::instance()->post();
            $where = ['coupon_name' => $param['coupon_name']];
            $result = Db::table('e_coupon')->where($where)->select();
            if(!empty($result)){
                return json(['code' => -1,'msg' => '该礼券名称重复！']);
            }
            $add_coupon = $coupon_model->add_coupon($param);
            return $add_coupon ? json(['code' => 1,'msg' => '添加成功！']) : json(['code' => -2,'msg' => '添加失败！']);
        }
        return $this->fetch('add_coupon');


    }


    /**
     * 删除礼券
     */
    public function Del_coupon(){
        $power_str = "shanchuliquan";
        if(!login_over_time()){
            return json(['code' => -1,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/coupon/index');
        }
        $coupon_model = new Couponm();
        $param = Request::instance()->get();
        $coupon_id = $param['coupon_id'];
        $status = $param['status'];
        $del_coupon = $coupon_model->Del_coupon($coupon_id,$status);
        return $del_coupon ? json(['code' => 1,'msg' => '删除成功！']) : json(['code' => -2,'msg' => '删除失败！']);


    }


    /**
     * 礼券详情
     */
    public function Details_coupon(){
        $power_str = "xiugailiquan";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/coupon/index');
        }
        $coupon_model = new Couponm();
        $coupon_id = input('coupon_id');
        $coupon_info = $coupon_model->coupon_info($coupon_id);
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $upate_coupon = $coupon_model->update_coupon($param);
            return $upate_coupon ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);
        }
        $this->assign('data',$coupon_info);
        return $this->fetch('coupon_details' );



    }




}