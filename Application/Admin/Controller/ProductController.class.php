<?php
namespace Admin\Controller;

class ProductController extends AdminController{

	public function index(){
		$list = M('Product')->select();

		$this->assign('list', $list);
		$this->display();
	}

	public function add(){
		$product = D('Product');
		if(IS_POST){
			$data = $product->create();
			if($data){
				$res = $product->data($data)->add();
				if($res){
					$this->success('添加成功', U('index'));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error($this->getError());
			}
		}else{

			$this->display('edit');
		}
	}

}