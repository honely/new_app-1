<?php
/**
 * 平台会员controller.
 * User: Pengfan
 * Date: 2017/10/26
 * Time: 12:02
 */
namespace app\Home\controller;
use app\Home\model\Userp;
use think\Cache;
use think\Controller;
use think\Db;
use think\Request;

class User extends Controller
{

    /**
     * 平台会员添加
     */
    public function Add_plat_user(){
        $power_str = "tijianpingtaihuiyuan";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行该操作！','home/index/index');
        }
        $user_model = new Userp();
        if(Request::instance()->isPost()){
            $param = Request::instance()->post();
            $rand_str = _rand_str(6);
            $select_res = Db::table('e_user')->where(['user_name' => $param['user_name']])->select();
            if($select_res){
                return json(['code' => -2,'msg' => '该昵称已被注册！']);
            }
            $add_plat_user = $user_model->add_plat_user($param,$rand_str);
            return $add_plat_user ? json(['code' => -1,'msg' => '添加成功！']) : json(['code' => -1,'msg' => '添加失败！']);
        }
        return $this->fetch('add_user');

    }


    /**
     * 获取会员列表信息
     */
    public function Get_user_list(){
        $power_str = "huiyuanliebiao";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行该操作！','home/index/index');
        }
        $user_model = new Userp();
        $page = input('page');
        if(isset($page) && null !== $page){
            $current = $page;
        }else{
            $current = 1;
        }
        $options = [
            'page'=>$current,
            'path'=>url('index')
        ];
        $get_user_list = $user_model->get_user_list($options);
        $this->assign('data',$get_user_list['data']);
        $this->assign('page',$get_user_list['page']);
        return $this->fetch('index');

    }



    /**
     * 会员禁言 & 恢复禁言
     */
    public function Gag_user(){
        $power_str = "huiyuanhuihuazhuangtai";
        if(!login_over_time()){
            $this->redirect('home/login/index');
        }
        if(!_mate_power($power_str)){
            $this->success('你没有权限进行该操作！','home/index/index');
        }
        $uid = input('uid');
        $status = input('status');
        $user_model = new Userp();
        $gag_user = $user_model->update_user_status($uid,$status);
        return $gag_user ? json(['code' => 1,'msg' => '修改成功！']) : json(['code' => -1,'msg' => '修改失败！']);

    }


    /**
     * 发送手机验证码
     */
    public function send_sms_code(){
        header('Content-Type: text/plain; charset=utf-8');
        $param = Request::instance()->post();
        $mobile = $param['mobile'];
        $accessKeyId = "LTAIz4qwld4JhGBD";
        $accessKeySecret = "W5GI4y9px8VQrvzc2NiJaOn0E7bPAt";
        $signName = "彭耀久";
        $templateCode = "SMS_94605099";
        $phoneNumbers = $mobile;
        $send_class = new \SmsDemo($accessKeyId,$accessKeySecret);
        $code = _rand_str(4);
        Cache::set('mobile_code_plat',$code);
        $send_code = $send_class->sendSms(
            $signName,
            $templateCode,
            $phoneNumbers,
            ['number' => $code]
        );
        $send_data = json_encode($send_code);
        if($send_data->Code == 'ok'){
            return json(['code' => 1,'msg' => '发送成功！']);
        }else{
            return json(['code' => -1,'msg' => $send_data->Message]);
        }
    }



    /**
     * 图片上传、视频、音频
     */
    public function Upload_file(){
        $route = '../public/headImg/';
        $host = "http://".$_SERVER['SERVER_NAME'];
        $file_url = upload_img('file',400000,$route,0);
        return json(['url_str' => $host.'/headImg/'.$file_url]);
    }




}