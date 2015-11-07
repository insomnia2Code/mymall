<?php
namespace Admin\Controller;

class GoodsController extends AdminController{

	public function index(){
		$goods = M('Goods');
		$list = $goods->where(array('is_display'=>1))->field(true)->select();

		$this->assign('list', $list);
		$this->display();
	}

	//添加商品
	public function add(){
		$goods = D('Goods');
		if(IS_POST){


		}else{


			$this->display('edit');
		}
	}
}