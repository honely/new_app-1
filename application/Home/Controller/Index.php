<?php
/**
 * 后台首页controller.
 * User: Pengfan
 * Date: 2017/10/19
 * Time: 14:02
 */
namespace app\Home\controller;
use think\Controller;

class Index extends Controller
{

    public function index(){
        return $this->fetch('index');
//        return $this->view('index');
    }

}
