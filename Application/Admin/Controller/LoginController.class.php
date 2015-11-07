<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{

	public function index($username = null, $password = null, $verify = null){
		if(IS_POST){
			/* 检测验证码 */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }

            $user = M('Admin')->where(array('username'=>$username))->find();
            if(!$user || md5($password) != $user['password']){
            	$this->error('用户名或密码输入错误');
            }

            session('id', $user['id']);
            session('username', $username);
            session('last_time', $user['last_time']);
            session('last_ip', long2ip($user['last_ip']));

            $data['id'] = $user['id'];
            $data['last_time'] = time();
            $data['last_ip'] = ip2long(get_client_ip());

            M('Admin')->data($data)->save();

            //TODO:跳转到登录前页面
            $this->success('登录成功！', U('Index/index'));
		}else{

            if(is_login()){
            	$this->redirect('Index/index');
            }else{
            	/*读取数据库中的配置*/
            	// $config = S('DB_CONFIG_DATA');
            	// if(!$config){
            	// 	$config = D('Config')->lists();
            	// 	S('DB_CONFIG_DATA', $config);
            	// }
            	// C($config);//添加配置

            	$this->display();
            }



		}

	}
	
	//生成验证码图片
    public function verify(){
    	$verify = new \Think\Verify();
    	$verify->entry(1);
    }

    /* 退出登录 */
    public function logout(){
    	if(is_login()){
    		session_unset();
    		session_destroy();
    	} else {
    		$this->redirect('login');
    	}
    }

}