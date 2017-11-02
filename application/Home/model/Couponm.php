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
     * @param $options 分页所需要的参数
     * @return array or null;
     */
    public function get_coupon_info($options){
        $data = Db::table('e_coupon')->order('add_time DESC')
                ->paginate(15,false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] :
                                  ['data' => '','page' => ''] ;
    }


    /**
     * 添加礼券
     * @param $data 添加礼券所需参数
     * @retun true or false;
     */
    public function add_coupon($data){
        if(isset($data['status']) && $data['status'] == 'on'){
            $status = 1;
        }else{
            $status = 3;
        }
        $insert_data = [
            'coupon_name' => $data['coupon_name'],
            'quota' => $data['quota'],
            'use_rule' => $data['use_rule'],
            'add_time' => time(),
            'effective_day' => $data['effective_day'],
            'status' => $status
        ];
        $res = Db::table('e_coupon')->insert($insert_data);
        return $res ? true : false;
    }


    /**
     * 删除礼券
     * @param  $coupon_id  礼券id  $status  礼券状态
     * @return true or false;
     */
    public function Del_coupon($coupon_id,$status){
        $update_data = [
            'status' => $status
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


    /**
     * 修改礼券
     * @param  $data 礼券的详情数据
     * @return true or false;
     */
    public function update_coupon($data){
        $upate_data = [
            'coupon_name' => $data['coupon_name'],
            'quota' => $data['quota'],
            'use_rule' => $data['use_rule'],
            'effective_day' => $data['effective_day']
        ];
        $res = Db::table('e_coupon')->where(['id' => $data['coupon_id']])->update($upate_data);
        return ($res || $res == 0) ? true : false;
    }




}