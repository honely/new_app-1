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
            'head_img' => "",
            'mobile' => $data['mobile'],
            'salt_str' => $rand_str,
            'register_ip' => $_SERVER['REMOTE_ADDR'],
            'integral' => config('def_integ'),
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


}