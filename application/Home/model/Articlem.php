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
                ->field('ar.*,ai.*,na.nav_name,us.user_name')
                ->join('e_article_info ai','ar.article_id = ai.article_id')
                ->join('e_user as us','us.uid = ar.uid')
                ->join('e_nav_list as na','ar.nav_id = na.nav_id')
                ->order('ar.add_time DESC')->paginate('15',false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] : null;
    }


    /**
     * 删除article
     * @param $article_id 作品id $status 作品状态
     * @return true or false;
     */
    public function del_article($article_id,$status){
        $res = Db::table('e_article')->where(['article_id' => $article_id])
               ->update([
                   'status' => $status
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
                ->field('ar.*,ai.*,us.uid,us.user_name,na.nav_name')
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
        $update_data = [
            'article_title' => $data['title'],
            'nav_id' => $data['nav_sort'],
            'update_time' => time()
        ];
        $update_info = [
            'content' => trim($data['content']," "),
            'img_url' => $data['img_url'],
        ];
        $res = Db::table('e_article')->where(['article_id' => $data['article_id']])
               ->update($update_data);
        $res_info = Db::table('e_article_info')->where(['article_id' => $data['article_id']])
                    ->update($update_info);
        return ($res || $res_info) ? true : false;
    }


    /**
     * 添加新作品
     * @param $data 作品数据
     * @return true or false;
     */
    public function add_new_article($data){
        $insert_data = [
            'article_title' => $data['title'],
            'nav_id' => $data['nav_sort'],
            'uid' => $data['uid'],
            'add_time' => time(),
            'status' => 1
        ];
        $res = Db::table('e_article')->insertGetId($insert_data);
        if($res){
            $insert_info_data = [
                'article_id' => $res,
                'content' => $data['content'],
                'img_url' => $data['img_url']
            ];
            $res_info = Db::table('e_article_info')->insert($insert_info_data);
            return $res_info ? true : false;
        }
        return false;
    }



}