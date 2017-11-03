<?php
/**
 * 文章评论controller.
 * User: Pengfan
 * Date: 2017/11/1
 * Time: 14:58
 */
namespace app\Home\controller;
use app\Home\model\Commentm;
use think\Controller;
use think\Db;

class Comment extends Controller
{

    /**
     * 文章评论列表
     */
    public function Index(){
        $power_str = "wenzhangpinglun";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $comment_model = new Commentm();
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
        $get_comment = $comment_model->get_article_comment($options);
        $this->assign('data',$get_comment['data']);
        $this->assign('page',$get_comment['page']);
        return $this->fetch('index');

    }


    /**
     * 删除文章评论
     */
    public function Update_comment_ststus(){
        $power_str = "deletezuopincomment";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $comment_id = input('comment_id');
        $status = input('status');
        $comment_model = new Commentm();
        $del_comment_status = $comment_model->del_comment($comment_id,$status);
        return $del_comment_status ? json(['code' => 1,'msg' =>'修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 商品评论列表
     */
    public function Get_pro_comment(){
        $power_str = "productcommentlist";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $comment_model = new Commentm();
        $page = input('page');
        if(isset($page) && $page !== null){
            $current = $page;
        }else{
            $current = 1;
        }
        $options = [
            'page' => $current,
            'url' => url('get_pro_comment')
        ];
        $get_pro_comment = $comment_model->get_product_comment($options);
        $this->assign('data',$get_pro_comment['data']);
        $this->assign('page',$get_pro_comment['page']);
        return $this->fetch('pro_comment');

    }


    /**
     * 修改商品评论状态
     */
    public function Update_pro_comment_status(){
        $power_str = "xiugaiprocommentstatus";
        if(!login_over_time()){
            return json(['code' => -2,'url' => 'home/login/index']);
        }
        if(!_mate_power($power_str)){
            $this->success('您没有权限进行该操作！','home/index/index');
        }
        $comment_id = input('comment_id');
        $status = input('status');
        $update_data = [
            'status' => $status,
        ];
        $res = Db::table('e_product_comment')
               ->where(['id' => $comment_id])
               ->update($update_data);
        return $res ? json(['code' => -1,'msg' => '修改成功！']) : json(['code' => -1,'msg' =>'修改失败！']);

    }


}