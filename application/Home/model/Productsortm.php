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
     * @return array or null;
     */
    public function get_sort_list(){
        $data = Db::table('e_product_sort')->select();
        return $data ? $data : null;
    }


    /**
     * 获取分类信息
     * @param  $sort_id  分类id
     * @return array or  null;
     */
    public function get_sort_info($sort_id){
        $one_data = Db::table('e_product_sort')
                    ->where(['sort_id' => $sort_id])
                    ->select();
        return $one_data ? $one_data : null;
    }


    /**
     * 修改分类信息
     * @param $sort_id  分类id   分类名称
     * @return true or false;
     */
    public function update_sort($sort_id,$sort_name){
        $upate_data = [
            'sort_name' => $sort_name
        ];
        $res = Db::table('e_product_sort')->where(['sort_id' => $sort_id])
               ->update($upate_data);
        return $res ? true : false;
    }



    /**
     * 添加新的分类
     * @param   $data  新分类数据
     * @return true or false;
     */
    public function add_new_sort($data){
        if(isset($data['status']) && $data['status'] == 'on'){
            $status = 1;
        }else{
            $status = 3;
        }
        if($data['level'] == 1){
            $insert_data = [
                'sort_name' => $data['sort_name'],
                'status' => $status
            ];
        }elseif($data['level'] == 2){
            $insert_data = [
                'parent_id' => $data['parent_id'],
                'sort_name' => $data['sort_name'],
                'status' => $status
            ];
        }

        $res = Db::table('e_product_sort')->insert($insert_data);
        return $res ? true : false;

    }




}