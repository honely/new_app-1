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


    }





}