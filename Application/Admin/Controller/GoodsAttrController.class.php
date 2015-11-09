<?php
namespace Admin\Controller;

class GoodsAttrController extends AdminController{

	public function index(){
		
		$this->display();
	}


	public function add(){
		$goodsAttr = D('GoodsAttr');
		if(IS_POST){



		}else{

			

			$this->display('edit');
		}
	}
}