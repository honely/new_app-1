<?php
/**
 * 商品Controller.
 * User: Pengfan
 * Date: 2017/11/3
 * Time: 16:12
 */
namespace app\HOme\controller;
use app\home\model\Productm;
use think\Controller;

class Product extends Controller
{


    /**
     * 商品列表
     */
    public function Product_list(){
        $power_str = "productlist";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $product_model = new Productm();
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
        $get_product_list = $product_model->get_product_list($options);
        $this->assign('data',$get_product_list['data']);
        $this->assign('page',$get_product_list['page']);
        return $this->fetch('index');

    }



}