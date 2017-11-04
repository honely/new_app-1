<?php
/**
 * 商品分类controller.
 * User: PengFan
 * Date: 2017/11/3
 * Time: 17:10
 */
namespace app\home\controller;
use app\home\model\Productsortm;
use think\Controller;
use think\Db;
use think\Request;

class Productsort extends Controller
{


    /**
     * 商品分类列表
     */
    public function Index(){
        $power_str = "prosortlist";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $productsort_model = new Productsortm();
        $get_sort_list = $productsort_model->get_sort_list();
        $this->assign('sort_data',$get_sort_list);
        return $this->fetch('index');

    }


    /**
     * 修改分类状态
     */
    public function Update_sort_status(){
        $power_str = 'updatesortstatus';
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $status = input('status');
        $sort_id = input('sort_id');
        $updata_data = [
            'status' => $status
        ];
        $res = Db::table('e_product_sort')
               ->where(['sort_id' => $sort_id])
               ->update($updata_data);
        return $res ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);


    }



    /**
     * 商品分类详情
     */
    public function Details_pro_sort(){
        $power_str = "updateprosort";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $sort_id = input('sort_id');
        $poSort_model = new Productsortm();
        if(Request::instance()->post()){
            $param = Request::instance()->post();
            $sort_id = $param['sort_id'];
            $sort_name = $param['sort_name'];
            $update_sotr = $poSort_model->update_sort($sort_id,$sort_name);
            return $update_sotr ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);
        }
        $get_pro_sort_info = $poSort_model->get_sort_info($sort_id);
        $this->assign('one_data',$get_pro_sort_info);
        return $this->fetch('details_sort');


    }



    /**
     * 添加分类
     */
    public function Add_sort(){
        $power_str = "addnewsort";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $sort_model = new Productsortm();
        if(Request::instance()->post()){
            $param = Request::instance()->post();
            $old_data = Db::table('e_product_sort')->where(['sort_name' => $param['sort_name']])->select();
            if(!empty($old_data)){
                return json(['code' => -3,'msg' => '该分类已存在！']);
            }
            $add_sort = $sort_model->add_new_sort($param);
            return $add_sort ? json(['code' => 1,'msg' => '添加成功！']) : json(['code' => -1,'msg' => '添加失败！']);
        }
        return $this->fetch('add_sort');

    }




}