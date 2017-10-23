<?php
/**
 * 分类导航model.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:10
 */
namespace app\Home\model;
use think\Model;

class Nav extends Model
{

    /**
     * table
     */
    protected $table = 'nav_list';


    /**
     * 获取分类导航信息
     * @return array or null;
     */
    public function get_sort_nav_info(){
        $data = parent::where(['status' => 1])->select();
        return $data ? $data : null;
    }




}