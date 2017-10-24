<?php
/**
 * 作品controller.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:00
 */
namespace app\Home\controller;
use app\Home\model\Articlem;
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

        $page = input('get.page');
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
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作！','home/index/index');
        }
        $article_model = new Articlem();
        $article_id = input('get.article_id');
        $del_article = $article_model->del_article($article_id);
        return $del_article ? json(['code' => 1,'msg' => '操作成功！']) : json(['code' => -1,'msg' => '操作失败！']);
    }


    /**
     * 查看详情
     */
    #TODO:页面数据尚未渲染
    public function Article_details(){
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        $article_id = input('get.article_id');
        $article_model = new Articlem();
        $get_article_info = $article_model->get_article_info($article_id);
        $this->assign('data',$get_article_info);
        return $this->fetch('details_article');
    }


    /**
     * 修改作品
     */
    public function Update_article(){
        $power_str = 'xiugaizuopin';
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行此操作!','home/index/index');
        }
        $param = Request::instance()->post();
        $article_model = new Articlem();
        $update_article = $article_model->Update_article($param);

    }






}