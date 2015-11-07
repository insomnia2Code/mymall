<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{


	protected function _initialize(){
		$menu = $this->getMenus();

		$this->assign('__MENU__', $menu);
	}


	//后台菜单
	protected function getMenus(){
		$menu = M('Menu');

		$main = $menu->where(array('pid'=>0,'is_display'=>1))->field('id,url,title')->select();

		foreach($main as $key => $val){
			if(CONTROLLER_NAME . '/' . ACTION_NAME == $val['url']){
				$main[$key]['class'] = 'current';
				$child = $menu->where(array('pid'=>$val['id'],'is_display'=>1))->field('id,url,title,group')->select();

				foreach($child as $k=> $v){
					$temp[$v['group']][] = $v;
				}
			}
		}

		$Menus['child'] = $temp;
		$Menus['main'] = $main;
		return $Menus;
	}

	


}