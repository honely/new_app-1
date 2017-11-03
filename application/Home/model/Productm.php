<?php
/**
 * 商品model.
 * User: Pengfan
 * Date: 2017/11/3
 * Time: 16:24
 */
namespace app\home\model;
use think\Db;
use think\Model;

class Productm extends Model
{

    /**
     * table
     */
    protected $table = 'e_product';



    /**
     * 获取商品信息
     * @param $options 分页参数
     * @return array or null;
     */
    public function get_product_list($options){
        $data = Db::table('e_product as pr')
                ->join('e_product_sort as so','so.sort_id=pr.sort_id')
                ->join('e_product_attr_val as attr','pr.pro_id=attr.product_id')
                ->join('e_sort_attr as rt','rt.attr_id=attr.attr_id')
                ->paginate(15,false,$options);
        $page = $data->render();
        return ($data || $page) ? ['data' => $data,'page' => $page] :
                                  ['data' => '','page' =>''];
    }



}