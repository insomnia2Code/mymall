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
				if(!empty($data['pic_arr'])){
					$data['pic_arr'] = implode(',', $data['pic_arr']);
				}
				
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

	//编辑商品
	public function edit($id = 0){
		$goods = D('Goods');
		if(IS_POST){
			$data = $goods->create();
			if($data){
				$res = $goods->data($data)->save();
				if($res){
					$this->success('修改成功', U('index'));
				}else{
					$this->error('修改失败');
				}
			}else{
				$this->error($goods->getError());
			}
		}else{
			$info = $goods->where(array('id'=>$id))->find();
			if($info['pic_arr']){
				$info['pic_arr'] = M('Picture')->where('id in ('.$info['pic_arr'].')')->field('path')->select();
			}	

            $category = M('GoodsCategory')->where(array('is_display'=>1))->field('id,title,pid')->select();
            $category = D('Common/Tree')->toFormatTree($category);
            $category = array_merge(array(0=>array('id'=>0, 'title'=>'顶级菜单')), $category);

            $this->assign('Category', $category);
			$this->assign('info', $info);
			$this->display('edit');
		}
	}
}