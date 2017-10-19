<?php
/**
 * QQ model.
 * User: Pengfan
 * Date: 2017/10/17
 * Time: 14:20
 */
namespace app\Admin\model;
use think\Model;

class Qqinfo extends Model
{

    /**
     * table
     */
    protected $table = 'qq';


    /**
     * 获取qq信息
     * @param $openid qq唯一标识openid
     * @return array or null;
     */
    public function get_qq_info($openid){
        $data = parent::where(['openId' => $openid])->select();
        return $data ? $data : null;
    }



}