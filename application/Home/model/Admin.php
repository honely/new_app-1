<?php
/**
 * 管理员model.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:30
 */
namespace app\Home\model;
use think\Db;
use think\Model;

class Admin extends Model
{


    /**
     * table
     */
    protected $table = 'e_admin_user';


    /**
     * 管理员登录
     * @param $user_name 账号  $pass_word 密码
     * @return array or null;
     */
    public function login($user_name,$pass_word){
        $pass_word = md5(md5($pass_word));
        $data = parent::where(['user_name' => $user_name,'pass_word' => $pass_word,'status' => 1])->select();
        return $data ? $data : null;
    }


    /**
     * 添加管理员
     * @param $user_name 用户名  $pass_word 密码
     * @return true or false;
     */
    public function add_user($user_name,$pass_word){
        $pass_word = md5(md5($pass_word));
        $this->user_name = $user_name;
        $this->pass_word = $pass_word;
        $res = $this->save();
        return $res ? true : false;
    }


    /**
     * 获取管理员列表
     * @return array or null;
     */
    public function get_admin_list(){
        $data = Db::table('e_admin_user')->select();
        return $data ? $data : null;
    }


    /**
     * 修改管理员状态
     * @param $uid 管理员id   $status 状态
     * @return true or false;
     */
    public function update_admin_status($uid,$status){
        $update_data = [
            'status' => $status
        ];
        $res = Db::table('e_admin_user')->where(['id' => $uid])->update($update_data);
        return $res ? true : false;
    }


    /**
     * 添加管理员权限
     * @param $data 权限数据
     * @return true or false;
     */
    public function add_admin_power($data){
        $update_data = [
            'power' => trim($data['power'],',')
        ];
        $res = Db::table('e_admin_user')->where(['id' => $data['uid']])->update($update_data);
        return ($res || $res == 0) ? true : false;
    }



}