<?php
namespace Admin\Controller;

class MenuController extends AdminController{

	public function index($pid = 0){

		$menu = D('Menu');
		$list = $menu->where(array('pid'=>$pid))->select();

		$this->assign('list', $list);
		$this->display();
	}

	//新增菜单
	public function add($pid = 0){
		$menu = D('Menu');
		if(IS_POST){			
			$data = $menu->create();
			if($data){				
				$res = $menu->data($data)->add();
				if($res){
					$this->success('添加成功',U('Menu/index', array('pid'=>$data['pid'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error($menu->getError());
			}
		}else{
			$menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus);
            $menus = array_merge(array(0=>array('id'=>0,'title'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);

            $this->assign('info', array('pid'=>$pid));
			$this->display('edit');
		}
	}

	//编辑惨淡
	public function edit($id = 0){
		$menu = D('Menu');
		if(IS_POST){
			$data = $menu->create();
			if($data){
				$res = M('Menu')->data($data)->save();
				if($res){
					$this->success('修改成功', U('Menu/index', array('pid'=>$data['pid'])));
				}else{
					$this->error('修改失败');
				}
			}else{	
				$this->error($menu->getError());
			}
		}else{
			$info = $menu->where(array('id'=>$id))->find();
			$menus = M('Menu')->field(true)->select();
			$menus = D('Common/Tree')->toFormatTree($menus);
			$menus = array_merge(array(0=>array('id'=>0, 'title'=>'顶级菜单')), $menus);

			$this->assign('Menus', $menus);
			$this->assign('info', $info);
			$this->display('edit');
		}
	}

}