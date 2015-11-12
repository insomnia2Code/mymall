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
			var_dump($_POST);
			DIE;


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

			//商品分类
            $category = M('GoodsCategory')->where(array('is_display'=>1))->field('id,title,pid')->select();
            $category = D('Common/Tree')->toFormatTree($category);
            $category = array_merge(array(0=>array('id'=>0, 'title'=>'顶级菜单')), $category);

            //商品类型
            $Product = M('Product')->where(array('status'=>0))->field('id,name')->select();
            $Product = array_merge(array(0=>array('id'=>0, 'name'=>'选择产品')), $Product);

            $this->assign('Product', $Product);
            $this->assign('Category', $category);
			$this->assign('info', $info);
			$this->display('edit');
		}
	}

	public function recycle(){
		$goods = M('Goods');
		$list = $goods->where(array('is_display'=>0))->field(true)->select();

		$this->assign('list', $list);
		$this->display();
	}

	public function del($id){
		$res = M('Goods')->where(array('id'=>$id))->data(array('is_display'=>0))->save();
		if($res){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	public function reback($id){
		$res = M('Goods')->where(array('id'=>$id))->data(array('is_display'=>1))->save();
		if($res){
			$this->success('还原成功');
		}else{
			$this->error('还原失败');
		}
	}

	public function delforever($id){
		$res = M('Goods')->where(array('id'=>$id))->delete();
		if($res){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}


	public function getAttr(){
		if(IS_POST){
			$type = I('post.product_id');
			$attr = M('GoodsAttr')->where(array('pid'=>0,'product_id'=>$type))->field('id,name')->select();
			sort($attr);
			$list = array();
			foreach($attr as $k => $v){ 
				$attrs = array();
				$attrs = M('GoodsAttr')->where(array('pid'=>$v['id']))->field('id,name')->select();
				if(count($attrs)){
					$attr[$k]['child'] = $attrs;
					$list[] = $attr[$k];
				}
			}

			$attrcont = build_attr_html($list);
			$data['status'] = 1;
			$data['content'] = $attrcont;
			$this->ajaxReturn($data);
		}
	}
}