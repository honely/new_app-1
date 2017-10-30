<?php
/**
 * 作品controller.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:00
 */
namespace app\Home\controller;
use app\Home\model\Articlem;
use app\Home\model\Navsort;
use app\home\model\Userp;
use think\Controller;
use think\Request;

class Article extends Controller
{

    /**
     * 作品列表
     */
    public function Index(){
        $power_str = "zuopinliebiao";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作！','home/index/index');
        }

        $page = input('page');
        $article_model = new Articlem();
        if (isset($page) && null !== $page) {
            $current = $page;
        }else {
            $current = 1;
        }
        $options = [
            'page'=>$current,
            'path'=>url('index')
        ];
        $get_article_list = $article_model->get_article_list_info($options);
        $this->assign('data', $get_article_list['data']);
        $this->assign('page', $get_article_list['page']);
        return $this->fetch('index');
    }


    /**
     * 删除
     */
    public function Del_article(){
        $power_str = "shanchuzuopin";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作！','home/index/index');
        }
        $article_model = new Articlem();
        $article_id = input('article_id');
        $status = input('status');
        $del_article = $article_model->del_article($article_id,$status);
        return $del_article ? json(['code' => 1,'msg' => '操作成功！']) : json(['code' => -1,'msg' => '操作失败！']);
    }


    /**
     * 查看详情
     */
    public function Article_details(){
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        $article_id = input('article_id');
        $article_model = new Articlem();
        $nav_model = new Navsort();
        $get_article_info = $article_model->get_article_info($article_id);
        $get_nav_list = $nav_model->get_sort_nav_info();
        $this->assign('data',$get_article_info);
        $this->assign('nav_data',$get_nav_list);
        return $this->fetch('details_article');
    }


    /**
     * 修改作品
     */
    public function Update_article(){
        $power_str = 'xiugaizuopin';
        if(!login_over_time()){
            $this->redirect('home/login/index');
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作!','home/index/index');
        }
        $param = Request::instance()->post();
        $article_model = new Articlem();
        $update_article = $article_model->Update_article($param);
        return $update_article ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 添加作品
     */
    public function Add_new_article(){
        $power_str = "tianjiaxinzuopin";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作!','home/index/index');
        }
        $nav_model = new Navsort();
        $user_model = new Userp();
        $get_user_list = $user_model->get_plat_user();
        $get_nav_list = $nav_model->get_sort_nav_info();
        $this->assign('nav_data',$get_nav_list);
        $this->assign('user_data',$get_user_list);
        $param = Request::instance()->post();
        if($param){
            $article_model = new Articlem();
            $add_article = $article_model->add_new_article($param);
            return $add_article ? json(['code' => 1,'msg' => '添加成功！'])   : json(['code' => -1,'msg' => '添加失败！']);
        }
        return $this->fetch('add_article');

    }


    /**
     * 图片上传、视频、音频
     */
    public function Upload_file(){
        $route = '../public/article/';
        $host = $_SERVER['SERVER_NAME'];
        $file_url = upload_img('file',400000,$route,0);
        return json(['url_str' => $host.'/article/'.$file_url]);
    }






}