<?php
namespace Admin\Controller;
use Think\Controller;
class RegisterController extends Controller {

  function register(){
    	if (!IS_POST) {
    	$this->error('操作失败','/Home/Index/Index',2);
    	}
        //方法一：
 //    	$data=array(
 //    		'lock'=>'0',
 //    		'registime'=>time(),
 //    		'ip'=>get_client_ip(),
 //    		'account'=>I('post.user'),
 //    		'password'=>md5(I('post.password')),
 //    		);
 //    	$info=array(
 //    		'username'=>I('post.names'),
 //    		);
 //    	if(D('user')->Insert($data)&&D('userinfo')->Insert($info))
 //    	{	
	// $this->success('恭喜注册成功！', '/weibo/Home/Index');
 //    	};
        //方法二：
     $data=array(
         'lock'=>'0',
         'registime'=>time(),
         'ip'=>get_client_ip(),
         'account'=>I('post.user'),
         'password'=>md5(I('post.password')),
         'userinfo'=>array(
            'username'=>I('post.names')
            )
         );

      $id=D('user')->insert($data);
     if ($id) {
        session('uid',$id);
        redirect('/Home/Index',3, '注册成功,页面跳转中...');
     }
    }
}
?>