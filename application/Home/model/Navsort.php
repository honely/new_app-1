<?php
/**
 * 分类导航model.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:10
 */
namespace app\Home\model;
use think\Db;
use think\Model;

class Navsort extends Model
{

    /**
     * table
     */
    protected $table = 'e_nav_list';


    /**
     * 获取分类导航信息
     * @return array or null;
     */
    public function get_sort_nav_info(){
        $data = Db::table('e_nav_list')->select();
        return $data ? $data : null;
    }


    /**
     * 添加新的导航
     * @param $data 导航数据
     * @return  true or false;
     */
    public function add_new_nav($data){
        $insert_data = [
            'nav_name' => $data['nav_name'],
            'add_time' => time(),
            'status' => 1
        ];
        $res = Db::table('e_nav_list')->insert($insert_data);
        return $res ? true : false;
    }


    /**
     * 修改导航状态
     * @param $id 导航id  $status 导航状态
     * @return true or false;
     */
    public function update_nav_status($id,$status){
        $update_data = [
            'status' => $status
        ];
        $res = Db::table('e_nav_list')->where(['nav_id' => $id])->update($update_data);
        return $res ? true : false;
    }


    /**
     * 获取导航信息
     * @param $nav_id 导航id
     * @return array or null;
     */
    public function get_nav_info($nav_id){
        $data = Db::table('e_nav_list')->where(['nav_id' => $nav_id])->select();
        return $data ? $data : null;
    }


    /**
     * 获取导航banner
     * @param $options 分页参数
     * @return array or null;
     */
    public function get_nav_banner($options){
        $data = Db::table('e_nav_banner as nav')
                ->join('e_nav_list as n','n.nav_id=nav.nav_id')
                ->field('n.nav_name')
                ->field('nav.*')
                ->paginate('15',false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data'=>$data,'page' => $page] : ['data' => '','page' => ''];
    }


    /**
     * 修改banner状态
     * @param $banner_id banner唯一id   $status 状态
     * @return true or false;
     */
    public function update_banner_status($banner_id,$status){
        $update_data = [
            'status' => $status
        ];
        $res = Db::table('e_nav_banner')->where(['id' => $banner_id])->update($update_data);
        return $res ? true : false;

    }


    /**
     * 添加导航banner
     * @param $data 导航banner数据
     * @return true Or false;
     */
    public function add_nav_banner($data){
        $insert_data = [
            'nav_id' => $data['nav_id'],
            'banner_img' => $data['banner_img'],
            'jump_url' => $data['jump_url'],
            'add_time' => time(),
            'status' => 1
        ];
        $res = Db::table('e_nav_banner')->insert($insert_data);
        return $res ? true : false;
    }


    /**
     * 修改导航信息
     * @param $data 修改后的导航数据
     * @return true or false;
     */
    public function update_nav_info($data){
        if(isset($data['status']) && $data['status'] == 'on'){
            $status = 1;
        }elseif(!isset($data['status'])){
            $status = 3;
        }
        $update_data = [
            'nav_name' => $data['nav_name'],
            'status' => $status
        ];
        $res = Db::table('e_nav_list')->where(['nav_id' => $data['nav_id']])->update($update_data);
        return ($res || $res == 0) ? true : false;

    }


    /**
     * 获取导航banner信息
     * @param $nav_banner_id banner唯一id
     * @return array or null;
     */
    public function get_nav_banner_info($nav_banner_id){
        $data = Db::table('e_nav_banner as ban')
                ->join('e_nav_list as nav',"ban.nav_id=nav.nav_id")
                ->where(['ban.id' => $nav_banner_id])
                ->field('ban.*')
                ->field('nav.nav_name')
                ->select();
        return $data ? $data : null;
    }


    /**
     * 修改导航banner信息
     * @param $data banner数据
     * @return true or false;
     */
    public function update_banner_info($data){
        $update_data = [
            'banner_img' => $data['banner_img'],
            'Jump_url' => $data['Jump_url'],
            'nav_id' => $data['nav_id']
        ];
        $res = Db::table('e_nav_banner')->where(['id' => $data['banner_id']])->update($update_data);
        return ($res || $res == 0) ? true : false;

    }




}