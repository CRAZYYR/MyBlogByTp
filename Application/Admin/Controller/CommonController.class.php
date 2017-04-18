<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	  public function __construct(){
        parent::__construct();
       if (isset($_COOKIE['auto']) && isset($_SESSION['uid'])) {
        
        $value=explode('|',enctyption(cookie('auto'),1));
        $ip=get_client_ip();
        if ($ip==$value[1] )
        {
        	$account=$value[0];

        	$rs=M('user')->where(array('account'=>$account))->field(array('id','lock'))->find();
        	
        	if ($rs&& !$rs['lock']) {
        		
        		session('uid',$rs['id'],3600);
        	}
        }
       }
       
        //判断用户是否应经登录！
           if (!session('uid')) {
         redirect(U('/Home/Index/index'),3, '你还未登陆,请登录...');
        	}
    
    }
    /**
     * 上传 文章图片
     * @return [type] [上传图片]
     */
  function uploadpicture(){
         $upload=$this->_upload('com/weibo/pic','180,80,50','180,80,50');
        echo json_encode($upload) ;
    
            
  }


    /** 
     * 上传图片
     */
    function uploadface(){
        if (!IS_POST) {
            echo "你的页面出错了";
            die;
        }

        $upload=$this->_upload('com/weibo/face','180,80,50','180,80,50');
        echo json_encode($upload) ;
    }

    function _upload($path,$width,$height){
         $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =  90014572800 ;// 设置附件上传大小
        $upload->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
        $upload->saveName = 'uniqid';
        $upload->savePath  =session('uid').'/'.$path.'/'; // 设置附件上传（子）目录
        $upload->thumb=true;
        $upload->thumbMaxWidth=$width;
        $upload->thumbMaxHeight=$height;
        $upload->thumbPrefix='max_,mediun_,mini_';
        $upload->thumbPath= $upload->savePath;
         $upload->thumbRemoveOrigin = true; 
         //上传图片后删除原图片  
        $upload->autoSub=true;//使用子目录
        $upload->dateFormat='Y_m';
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            return array('status'=>0);
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
         $rs= $file['savepath'].'|'.$file['savename'];
        return array(
            'status'=>1,
            'path'=>$file['savepath'],
         'savename'=>$file['savename']
            );

            }
        }
        
    }
  
    //函数结束
	  /**
     * [addGroup 微博好友分组]
     */
    function addGroup(){
        $data=array(
            'name'=>I('post.name'),
            'uid'=>session('uid')
            );
        if (M('group')->data($data)->add()) {
            echo json_encode(array('status'=>1,'msg'=>'插入成功'));
        }else{
            echo json_encode(array('status'=>0,'msg'=>'插入失败'));
        }
    }
    function addFollow(){
        echo("arg1");
        dump($_POST);
    }
    /**
     * [AddgroupList 关注的人加入分组
     * ]
     */
    function AddgroupList(){
        $follow=I('post.follow');
        $gid=I('post.gid');
        
        $data=array('gid'=>$gid,'follow'=>$follow,'fans'=>session('uid'));
        if (M('follow')->data($data)->add()) {
            // 添加成功后userinfo表中的粉丝和关注的数量增加
            $datas=M('userinfo');
           $rs=$datas->where(array('uid'=>$data['follow']))->setInc('fans');
           $datas->where(array('uid'=>$data['fans']))->setInc('follow');
    
            echo json_encode(array('status'=>1,'msg'=>'添加成功!'));
        }else{
               echo json_encode(array('status'=>0,'msg'=>'添加失败!'));
        }


    }
}
?>
