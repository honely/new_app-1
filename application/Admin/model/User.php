<?php
/**
 * 会员model.
 * User: Pengfan
 * Date: 2017/10/13
 * Time: 15:04
 */
namespace app\Admin\model;
use think\Model;

class User extends Model
{

    /**
     * table
     */
    protected $table = 'user';

    /**
     * 获取用户信息
     * @param $data 登录数据(账号，密码);
     * @return array or null;
     */
    public function get_user_info($data){
        $where = ['user_name' => $data['user_name']];
        $result = parent::where($where)->select();
        if($result){
            $pass_word = md5(md5($data['pass_word']).$result[0]['salt_str']);
            if($pass_word == $result['pass_word']){
                return ['code' => 1,'msg'=>'登录成功！','data' => $result[0]];
            }else{
                return ['code' => -1,'msg'=>'密码错误！','data' => ""];
            }
        }else{
            return ['code' => -2,'msg'=>'该用户不存在！','data' => ""];
        }
    }


    /**
     * 会员注册
     * @param $data 会员注册数据   $rand_str 随机字符串
     * @return true or false;
     */
    public function add_user_info($data,$rand_str,$ip){
        $data = parent::where(['user_name' => $data['user_name']])->select();
        if($data){
            return ['code' => -3,'msg' => '该用户名已存在！'];
        }
        $model = new User;
        $pass_word = md5(md5($data['pass_word']).$rand_str);
        $model->user_name = $data['user_name'];
        $model->pass_word = $pass_word;
        $model->head_img = $data['head_img'];
        $model->mobile = $data['mobile'];
        $model->salt_str = $rand_str;
        $model->register_ip = $ip;
        $model->integral = config('def_integ');
        $model->add_time = time();
        $model->status = 1;
        $res = $model->save();
        if($res !== false){
            return ['code' => 1,'msg' => '注册成功！'];
        }else{
            return ['code' => -2,'msg' => '注册失败！'];
        }

    }


    /**
     * 修改会员密码
     * @param $uid  会员uid $new_pw 修改的新密码
     * @return true or false;
     */
    public function update_pw($uid,$new_pw){
        $resutl = parent::where(['uid' => $uid])->update(['pass_word' => $new_pw]);
        return $resutl ? true : false;
    }


    /**
     * 修改绑定的手机号
     * @param $uid 会员uid  $new_mobile 新的手机号
     * @return true or false;
     */
    public function update_mobile($uid,$new_mobile){
        $result = parent::where(['uid' => $uid])->update(['mobile' => $new_mobile]);
        return $result ? true : false;
    }


    /**
     * 修改会员头像
     * @param $img_url 会员新头像 $uid 会员uid
     * @return true or false;
     */
    public function update_head_img($img_url,$uid){
        $result = parent::where(['uid' => $uid])->update(['head_img' => $img_url]);
        return $result ? true : false;
    }




}