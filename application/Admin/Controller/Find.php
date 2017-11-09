<?php
/**
 * 首页controller.
 * User: Pengfan
 * Date: 2017/11/9
 * Time: 11:32
 */
namespace app\Admin\controller;
use app\Admin\model\Navsort;
use think\Controller;

class  Find extends Controller
{

    /**
     * 导航nav
     */
    public function Get_nav(){
        $navsort_model = new Navsort();
        $get_nav_list = $navsort_model->get_nav_list();
        return json(['code' => 1,'msg' => 'success','data' => $get_nav_list]);
    }


    /**
     * 获取nav_banner
     */
    public function Get_nav_banner(){
        $nav_model = new Navsort();
        $nav_id = input('nav_id');
        if(empty($nav_id)){
            return json(['code' => -2,'msg' => '导航id为空！']);
        }
        $get_banner = $nav_model->get_nav_banner($nav_id);
        return json(['code' => 1,'msg' => 'success','data' => $get_banner]);

    }


    /**
     * 获取分类导航内容
     */
    public function Get_nav_article(){
        $nav_id = input('nav_id');
        $page = input('page');
        if(empty($nav_id) && empty($page)){
            return json(['code' => -2,'msg' => '导航id和页数为空！']);
        }
        $navsort_model = new Navsort();
        $get_article_list = $navsort_model->get_article_list($nav_id,$page);
        return json(['code' => 1,'msg' => 'success','data' => $get_article_list]);


    }




}
