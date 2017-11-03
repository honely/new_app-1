<?php
/**
 * 文章评论model.
 * User: Pengfan
 * Date: 2017/11/1
 * Time: 15:01
 */
namespace app\Home\model;
use think\Db;
use think\Model;

class Commentm extends Model
{



    /**
     * table
     */
    protected $table = 'e_comment';


    /**
     * 获取文章评论
     * @param $options 分页参数
     * @return array or null;
     */
    public function get_article_comment($options){
        $data = Db::table('e_comment as co')
                ->join('e_user as us','us.uid=co.uid')
                ->join('e_article as ar','ar.article_id=co.article_id')
                ->field('co.*')
                ->field('us.user_name')
                ->field('ar.article_title')
                ->paginate('15',false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] : ['data' => '','page' => ''];
    }



    /**
     * 修改文章状态
     * @param $comment_id  评论id   $status  评论状态
     * @return true or false;
     */
    public function del_comment($comment_id,$status){
        $update_data = [
            'status' => $status,
        ];
        $res = Db::table('e_comment')->where(['id' => $comment_id])
               ->update($update_data);
        return ($res || $res == 0) ? true : false;
    }


    /**
     * 获取商品评论
     * @param $options  分页参数
     * @return array or null;
     */
    public function get_product_comment($options){
        $data = Db::table('e_product_comment as co')
                ->join('e_user as us','us.uid=co.uid')
                ->join('e_product as ar','ar.pro_id=co.product_id')
                ->field('co.*')
                ->field('us.user_name')
                ->field('ar.product_name')
                ->paginate('15',false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] : ['data' => '','page' => ''];
    }



}