<?php
namespace Admin\Controller;

class GoodsAttrController extends AdminController{

	public function index(){
		
		$this->display();
	}


	public function add($product_id = 0){
		$goodsAttr = D('GoodsAttr');
		if(IS_POST){
			$data = $goodsAttr->create();
			if($data){
				$res = $goodsAttr->data($data)->add();
				if($res){
					$this->success('添加成功', U('attrlist', array('product_id'=>$data['product_id'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error($goodsAttr->getError());
			}
		}else{
			$attrList = $goodsAttr->where(array('pid'=>0,'status'=>0))->field('id,name')->select();
			
			$this->assign('attr', $attrList);
			$this->display('edit');
		}
	}

	public function lists($product_id = 0){
		$list = M('GoodsAttr')->where(array('product_id'=>$product_id))->select();

		$this->assign('list', $list);
		$this->display('lists');
	}

	public function attrlist($attr_id = 0){
		$list = M('GoodsAttr')->where(array('pid'=>$attr_id))->select();

		$this->assign('list', $list);
		$this->display();
	}

	public function edit($id = 0){
		$goodsAttr = D('GoodsAttr');
		if(IS_POST){
			$data = $goodsAttr->create();
			if($data){
				$res = $goodAttr->data($data)->save();
				if($res){
					$this->success('修改成功', U('attrlist', array('attr_id'=>$data['pid'])));
				}else{
					$this->error('修改失败');
				}
			}else{
				$this->error($goodsAttr->getError());
			}
		}else{

			$this->display('edit');
		}
	}

	public function attradd($attr_id){
		$goodsAttr = D('GoodsAttr');
		if(IS_POST){
			$data = $goodsAttr->create();
			if($data){
				$res = $goodsAttr->data($data)->add();
				if($res){
					$this->success('添加成功', U('GoodsAttr/attrlist', array('attr_id'=>$data['pid'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error($this->getError());
			}
		}else{


			$this->display();
		}
	}

	public function del($id = 0){
		$res = M('GoodsAttr')->where(array('id'=>$id))->delete();
		if($res){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
}