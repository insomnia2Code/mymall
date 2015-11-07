<?php
namespace Admin\Model;
use Think\Model;

class GoodsCategoryModel extends Model{

	 /**
	* 获取分类详细信息
	* @param milit $id 分类ID或标识
	* @param boolean $field 查询字段
	* @param array 分类信息
    */
    public function info($id, $field = true){
    	/*获取分类信息*/
    	$map = array();
    	if(is_numeric($id)){ //通过ID查询
    		$map['id'] = $id;
    	}else{ //通过标识查询
    		$map['title'] = $id;
    	}
    	return $this->field($field)->where($map)->find();
    }	

    /**
	* 获取分类树，指定分类则返回指定分类及其子分类，不指定则返回所有分类树
	* @param integer $id 	分类id
	* @param boolean $field 查询字段
	* @param array 			分类树
    */
    public function getTree($id = 0, $field = true){
    	/*获取当前分类信息*/
    	if($id){
    		$info = $this->info($id);
    		$id = $info['id'];
    	}

    	/*获取所有分类*/
    	$map = array('status' => array('gt', -1));
    	$list = $this->field($field)->where($map)->order('listorder')->select();
    	$list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_', $root = $id);

    	/*获取返回数据*/
    	if(isset($info)){ //指定分类则返回当前分类及其子分类
    		$info['_'] = $list;
    	}else{ //否则返回所有分类
    		$info = $list;
    	}
    	return $info;
    }
}
