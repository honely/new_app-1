<?php
/**
 * 管理员model.
 * User: Pengfan
 * Date: 2017/10/23
 * Time: 15:30
 */
namespace app\Home\model;
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
        $data = parent::where(['user_name' => $user_name,'pass_word' => $pass_word])->select();
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



}