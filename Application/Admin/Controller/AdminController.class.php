<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{


	protected function _initialize(){
		$menu = $this->getMenus();

	}


	//后台菜单
	protected function getMenus(){
		return null;
	}

	public function index(){
		echo 1;
	}


}