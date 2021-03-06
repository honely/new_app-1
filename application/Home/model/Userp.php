<?php
/**
 * 会员model.
 * User: Pengfan
 * Date: 2017/10/26
 * Time: 12:47
 */
namespace app\home\model;
use think\Db;
use think\Model;

class Userp extends Model
{

    /**
     * table
     */
    protected $table = "e_user";


    /**
     * 添加平台会员
     * @param $data  会员基本信息数据 $rand_str 随机字符
     * @return true or false;
     */
    public function add_plat_user($data,$rand_str){
        $pass_word = md5(md5($data['pass_word']).$rand_str);
        $isert_data = [
            'user_name' => $data['user_name'],
            'pass_word' => $pass_word,
            'head_img' => $data['head_img'],
            'mobile' => $data['mobile'],
            'salt_str' => $rand_str,
            'register_ip' => $_SERVER['REMOTE_ADDR'],
            'integral' => config('def_integ'),
            'is_plat' => 1,
            'add_time' => time(),
            'status' => 1
        ];
        $res = Db::table('e_user')->insert($isert_data);
        return $res ? true : false;
    }


    /**
     * 获取平台会员
     * @return array or null;
     */
    public function get_plat_user(){
        $data = Db::table('e_user')->where(['is_plat' => 1])->select();
        return $data ? $data : null;
    }


    /**
     * 获取会员列表
     * @param $options  分页参数
     * @return array or null;
     */
    public function get_user_list($options){
        $data = Db::table('e_user')->order('add_time DESC')->paginate(15,false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] : null;
    }


    /**
     * 会员禁言状态
     * @param $uid 会员id  $status 会员状态
     * @return true or false;
     */
    public function update_user_status($uid,$status){
        $data = ['status' => $status];
        $res = Db::table('e_user')->where(['uid' => $uid])->update($data);
        return $res ? true : false;
    }


    /**
     * 发送礼券
     * @param $coupon_id 礼券id   $uid  会员uid
     * @return true or false;
     */
    public function send_coupon($coupon_id,$uid){
        $data = Db::table('e_coupon')->where(['id' => $coupon_id])->select();
        $time = time();
        $day = $data[0]['effective_day'];
        if($data[0]['effective_day']){
            $over_time = date("Y-m-d H:i:s",strtotime("+$day day"));
        }else{
            $over_time = date("Y-m-d H:i:s",strtotime("+1 day"));
        }
        $insert_data = [
            'uid' => $uid,
            'coupon_id' => $coupon_id,
            'add_time' => $time,
            'overdue_time' => strtotime($over_time),
            'status' => 1
        ];
        $res = Db::table('e_user_coupon')->insert($insert_data);
        return $res ? true : false;
    }


}
