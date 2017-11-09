<?php
/**
 * 分类导航model.
 * User: Pengfan
 * Date: 2017/11/9
 * Time: 11:38
 */
namespace app\Admin\model;
use think\Db;
use think\Model;

class Navsort extends Model
{

    /**
     * table
     */
    protected $table = 'e_nav_list';


    /**
     * 获取导航分类
     * @return array or null;
     */
    public function get_nav_list(){
        $data = Db::table('e_nav_list')
                ->where(['status' => 1])
                ->select();
        return $data ? $data : null;
    }


    /**
     * 获取导航banner
     * @param $nav_id  导航id
     * @return array or null;
     */
    public function get_nav_banner($nav_id){
        $data = Db::table('e_nav_banner')
                ->where(['nav_id' => $nav_id,'status' => 1])
                ->select();
        return $data ? $data : null;
    }


    /**
     * 获取作品
     * @param $nav_id  导航id
     * @param $page    第几页
     * @return array or null;
     */
    public function get_article_list($nav_id,$page){
        $page = abs($page - 1);
        $data = Db::table('e_article as ar')
                ->join('e_article_info as ai','ai.article_id = ar.article_id')
                ->join('e_user as us','ar.uid = us.uid')
                ->where(['ar.nav_id' => $nav_id,'ar.status' => 1])
                ->order('ar.add_time DESC')
                ->field('ar.*,ai.content,ai.img_url,ai.music_url,ai.video_url,us.user_name')
                ->limit($page*10,'10')
                ->select();
        return $data ? $data : null;

    }


}