<?php
namespace Admin\Controller;

class IndexController extends AdminController{


	//后台首页
	public function index(){

        $this->meta_title = '管理首页';
        $this->display();
	}



}