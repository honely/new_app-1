<?php
/**
 * 礼券model.
 * User: Pengfan
 * Date: 2017/11/1
 * Time: 16:00
 */
namespace app\Home\model;
use think\Db;
use think\Model;

class Couponm extends Model
{


    /**
     * table
     */
    protected $table = 'e_coupon';


    /**
     * 获取礼券列表信息
     * @return array or null;
     */
    public function get_coupon_info(){
        $data = Db::table('e_coupon')->order('add_time DESC')->select();
        return $data ? $data : null;
    }


    /**
     * 添加礼券
     * @param $data 添加礼券所需参数
     * @retun true or false;
     */
    public function add_coupon($data){
        $insert_data = [
            'coupon_name' => $data['coupon_name'],
            'quota' => $data['quota'],
            'use_rule' => $data['use_rule'],
            'add_time' => time(),
            'status' => 1
        ];
        $res = Db::table('e_coupon')->insert($insert_data);
        return $res ? true : false;
    }


    /**
     * 删除礼券
     * @param  $coupon_id  礼券id
     * @return true or false;
     */
    public function Del_coupon($coupon_id){
        $update_data = [
            'status' => 3
        ];
        $where = ['id' => $coupon_id];
        $res = Db::table('e_coupon')->where($where)->update($update_data);
        return $res ? true : false;
    }


    /**
     * 礼券详情
     * @param  $coupon_id 礼券id
     * @return array or null;
     */
    public function coupon_info($coupon_id){
        $data = Db::table('e_coupon')->where(['id' => $coupon_id])->select();
        return $data ? $data : null;
    }




}