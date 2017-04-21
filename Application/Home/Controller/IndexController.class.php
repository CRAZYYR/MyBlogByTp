<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
  function loginOut(){
    session_unset();
    session_destroy();
    setcookie("auto", "",time()-3600);
    redirect('/Home/Index/index',3,'正在退出，请稍等...');
  }
    public function index(){

        $this->display();
    }
    public function reg(){
    	 $this->display();
    }
    public function Imag(){
      ob_clean();
     
    $config =    array(
    'fontSize'    =>    20,    // 验证码字体大小
    'length'      =>    4,     // 验证码位数
    'useNoise'    =>    false, // 关闭验证码杂点
	);
	$Verify =     new \Think\Verify($config);
	$Verify->codeSet = '0123456789'; 
	$Verify->useImgBg = true;
	$Verify->entry();

    }
    /**
     * 异步验证user信息
     */
    function checkUser(){
        if (!IS_AJAX) {
           echo "页面不存在！"; 
        }else{
    	$user=I('post.username');
    	$data=D('user');
      
    	 if ($data->where(array('account'=>$user))->find()) {
    	 	echo 'false';
        
    	 }else{
      echo 'true';
    }
        }
    	
    }
    /**
     * 图片检查开始
     */
 function index_imgck(){
    	
     $img=I('post.img');
		$verify = new \Think\Verify();
   
		if (!$verify->check($img, $id)) { 
      echo 'false';
		}else{
		 echo 'true';
		}

    }
    /**
     * 图片检验结束
     */
}