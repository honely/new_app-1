<?php
/**
 * 作品model.
 * User: Pengfan
 * Date: 2017/10/24
 * Time: 12:55
 */
namespace app\Home\model;
use think\Db;
use think\Model;

class Articlem extends Model
{

    /**
     * table
     */
    protected $table = "e_article";


    /**
     * 获取作品列表信息
     * @param $options 分页参数
     * @return array or null;
     */
    public function get_article_list_info($options){
        $data = Db::table('e_article')->alias('ar')
                ->join('e_article_info ai','ar.article_id = ai.article_id')
                ->join('e_user as us','us.uid = ar.uid')
                ->join('e_nav_list as na','ar.nav_id = na.nav_id')
                ->paginate('15',false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] : null;
    }


    /**
     * 删除article
     * @param $article_id 作品id
     * @return true or false;
     */
    public function del_article($article_id){
        $res = Db::table('e_article')->where(['article_id' => $article_id])
               ->update([
                   'status' => 3
               ]);
        return $res ? true :false;
    }


    /**
     * 获取作品信息
     * @param $article_id 作品id
     * @return array or null;
     */
    public function get_article_info($article_id){
        $data = Db::table('e_article')->alias('ar')
                ->join('e_article_info as ai','ar.article_id = ai.article_id')
                ->join('e_user as us','us.uid = ar.uid')
                ->join('e_nav_list as na','na.nav_id = ar.nav_id')
                ->where(['ar.article_id' => $article_id])
                ->select();
        return $data ? $data : null;
    }


    /**
     * 修改作品信息
     * @param $data 作品数据
     * @return true or false;
     */
    public function Update_article($data){

    }



}