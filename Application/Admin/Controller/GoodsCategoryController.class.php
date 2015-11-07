<?php
namespace Admin\Controller;

class GoodsCategoryController extends AdminController{

	public function index(){
        $tree = D('GoodsCategory')->getTree(0, 'id,title,listorder,is_display,pid,status');
        $this->assign('tree', $tree);
        C('_SYS_GET_CATEGORY_TREE_', true);
        $this->meta_title = '分类管理';
        $this->display();
	}

	/**
     * 显示分类树，仅支持内部调
     * @param  array $tree 分类树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function tree($tree = null){
        C('_SYS_GET_CATEGORY_TREE_') || $this->_empty();
        $this->assign('tree', $tree);
        $this->display('tree');
    }

    public function add($pid = 0){
    	$goodsCategory = D('GoodsCategory');
    	if(IS_POST){
    		$data = $goodsCategory->create();
    		if($data){
    			$res = $goodsCategory->data($data)->add();
    			if($res){
    				$this->success('添加成功', U('index'));
    			}else{
    				$this->error('添加失败');
    			}
    		}else{
    			$this->error($goodsCategory->getError());
    		}
    	}else{
    		$category = $goodsCategory->where(array('id'=>$pid))->field('title,id')->find();
    		$this->assign('category', $category);
    		$this->display('edit');
    	}
    }

    public function edit($id = 0){
    	$goodsCategory = D('GoodsCategory');
    	if(IS_POST){
    		$data = $goodsCategory->create();
    		if($data){
    			$res = $goodsCategory->data($data)->save();
    			if($res){
    				$this->success('修改成功', U('index'));
    			}else{
    				$this->error('修改失败');
    			}
    		}else{
    			$this->error($goodsCategory->getError());
    		}
    	}else{
    		$info = $goodsCategory->where(array('id'=>$id))->find();
    		$category = $goodsCategory->where(array('id'=>$info['pid']))->find();

    		$this->assign('category', $category);
    		$this->assign('info', $info);
    		$this->display('edit');
    	}
    }

}