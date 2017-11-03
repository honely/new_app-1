<?php
/**
 * 商品分类model.
 * User: Pengfan
 * Date: 2017/11/3
 * Time: 17:15
 */
namespace app\home\model;
use think\Db;
use think\Model;

class Productsortm extends Model
{


    /**
     * table
     */
    protected $table = 'e_product_sort';



    /**
     * 获取分类
     */
    public function get_sort_list(){
        $data = Db::table('e_product_sort')->select();
    }




}