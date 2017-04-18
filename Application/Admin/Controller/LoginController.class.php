<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    function login(){

        //判断提交方式。
        if (!IS_POST) {
   
        $this->error('操作失败','/Home/Index',2);
        }
        $account=I('post.user');
        $password=md5(I('post.password'));
        $rs=M('user')->where(
        	array(
        	'account'=>$account,
        	'password'=>$password
        	))->find();
        if(!$rs){
        	$this->error('你的账户或密码错误！');
        }elseif ($rs['lock']) {
        	$this->error('你的账户被锁定！');
        }
       
        if (isset($_POST['checkbox'])) {
            $account=$rs['account'];
            $ip=$rs['ip'];
            $client=get_client_ip();
            //指定cookie保存时间
         
            $value=enctyption($account.'|'.$client);
           cookie('auto',$value,3600); 
          // dump($_COOKIE);
         
        }
        session('uid',$rs['id']);
         redirect('/Admin/Index',3, '登陆成功,页面跳转中...');
    }
    
  
}
?>