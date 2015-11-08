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
			$data = $goods->create();
			if($data){
				$res = $goods->data($data)->add();
				if($res){
					$this->success('添加成功', U('index'));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error($goods->getError());
			}
		}else{
			$category = M('GoodsCategory')->where(array('is_display'=>1))->field('id,title,pid')->select();
            $category = D('Common/Tree')->toFormatTree($category);
            $category = array_merge(array(0=>array('id'=>0,'title'=>'顶级菜单')), $category);


            $this->assign('Category', $category);
			$this->display('edit');
		}
	}
}