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

		$main = $menu->where(array('pid'=>0,'hide'=>0))->field('id,url,title')->order('listorder desc')->select();

		foreach($main as $key => $val){
			if(CONTROLLER_NAME . '/' . ACTION_NAME == $val['url']){
				$main[$key]['class'] = 'current';
				$map['pid'] = $val['id'];
				
			}else{
				$map['pid'] = $menu->where('pid !=0 and url like \'%' . CONTROLLER_NAME . '/' . ACTION_NAME . '%\'')->getField('pid');
			}
		}

		// 查找当前主菜单
	    $nav =  M('Menu')->find($map['pid']);
	    if($nav['pid']){
	        $nav   =   M('Menu')->find($nav['pid']);
	    }
		foreach($main as $k=>$v){
			if($v['id'] == $nav['id']){
				$main[$k]['class'] = 'current';
			}else{
				continue;
			}
		}
		$map['pid'] = $nav['id'];
		$map['hide'] = 0;
		$child = $menu->where($map)->field('id,url,title,group')->select();

		foreach($child as $k=> $v){
			$temp[$v['group']][] = $v;
		}


		$Menus['child'] = $temp;
		$Menus['main'] = $main;
		return $Menus;
	}

	


}