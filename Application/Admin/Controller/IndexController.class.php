<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    //首页管理
    public function index(){
   
        $data=D('WeiboView');
     $info=array(session('uid'));
      $rs=M('follow')->where(array('fans'=>session('uid')))->
      field('follow')->select();
      if ($rs) {
            foreach ($rs as $v) {
          $info[]=$v['follow'];
        }
      }
    
      $data=$data->getALL(array('uid'=>array('IN',$info)));
    // //对数组按时间排序
    // foreach ($data['list'] as $key => $value) {
    //   $num[$key]=$value['time'];
    // }
    // array_multisort($num,SORT_DESC,$data['list']);
    // //排序结束
   // dump($data['list']);
   
    $this->assign('result_blog',$data['list']);

    $this->assign('pageweibo',$data['page']);
     $this->display();
    }
    function turn_weibo(){
      dump($_POST);
    }
    /**
     * [turn_comment_ajax 评论加载]
     * @return [type] [返回评论内容]
     */
    function turn_comment_ajax(){
     sleep(1);
     $wid=I('post.wid');
       $where=array('wid'=>$wid);
         $count=M('comment')->where($where)->count();
      $totle=ceil($count/4);
      $page=isset($_POST['page']) ? I('post.page'): 1;
      $limit=$page < 2 ? '0,4' : (4*($page-1)).',4';
       $data=D('CommentView')->where($where)->limit($limit)->order('id desc')->select(); 
      $str='';
     foreach ($data as $v) {
  
      $str.='<div class="panel panel-default">';
      $str.=' <div class="panel-heading">来自<a href="'.U('/Admin/User/'.$v['username']).'"><font color="red">'.$v['username'].'</font></a>评论<font color="red">('.time_formt($v['time']).'):</font></div>
      <div class="panel-body">';
          
      $str.='<p><img src="'.__ROOT__.'/uploads/'.$v['face'].'" height="40px" width="40px"></p>';
      $str.='<p style="padding:10px;line-height:20px; font-size="10px;">'.$v['username'].' : <font color="blue">'.$v['content'].'</font></p>';          
      $str.='<a  href="#" style="margin-right:5px; float: right;">回复</a></div></div>';  
      
      }
      if($totle>1){
        $str.='<dl class="clickme'.$wid.'">';
        switch ($page) {
          case 1<$page && $page<$totle:
              $str.=' <dd page="'.($page-1).'" wid="'.$wid.'">上一页</dd>
              <dd page="'.($page+1).'" wid="'.$wid.'">下一页</dd>';
            break;
          case $page<$totle:
              $str.='<dd page="'.($page+1).'" wid="'.$wid.'">下一页</dd>';
              break;
            case $page==$totle:
            $str.='<dd page="'.($page-1).'" wid="'.$wid.'">上一页</dd>';
            break;

        }
        $str.='</dl>';

      }
      

        echo $str;




        
    }
    /**
     * [turn 微博的转发]
     * @return [type] [description]
     */
     function turn(){

      $id= $_POST['tid'] ? $_POST['tid']:$_POST['id'];
     $data=array(
      'content'=>$_POST['content'],
      'isturn'=>$id,
      'uid'=>session('uid'),
      'time'=>time(),
      'ip'=>get_client_ip()
      );

         if(M('weibo')->data($data)->add()){
            if(isset($_POST['comment']))
            {
                if( M('comment')->data(array(
                  'content'=>$_POST['content'],
                  'time'=>time(),
                  'uid'=>session('uid'),
                  'wid'=>$id
                  ))->add())
                {
                   M('weibo')->where(array('id'=>$id))->setInc('comment');
                   if(isset($_POST['nid'])){
                      M('weibo')->where(array('id'=>$_POST['nid']))->setInc('comment');
                   }
                 }
              
            }

              if(M('weibo')->where(array('id'=>$id))->setInc('turn')){
                if(isset($_POST['nid'])){
                M('weibo')->where(array('id'=>$_POST['nid']))->setInc('turn');
                 }
                    M('userinfo')->where(array('uid'=>session('uid')))->setInc('weibo');

                  }else{
                    $this->error('转发失败...', '/Admin/index',1);
                  };
         
         $this->success('转发成功...', '/Admin/index',1);
            

           }

    }

  public function TestCode(){
  	$this->display();
  }
  function demo(){
  	$this->display();
  }
  /**
   * [comment 对微博的评论]
   * @return [type] [微博评论成功与否和json对象]
   */
  function comment(){
    $data=array(
    'content'=>I('post.comment'),
    'wid'=>I('post.wid'),
    'uid'=>session('uid'),
    'time'=>time()
    );
    $info=M('userinfo')->where(array('uid'=>session('uid')))->field(array('face50'=>'face','uid','username'))->find();
      
      $str='';
      $str.='<div class="panel panel-default">';
      $str.=' <div class="panel-heading">来自<a href="'.U('/Admin/User/'.$info['username']).'"><font color="red">'.$info['username'].'</font></a>评论<font color="red">('.time_formt($data['time']).'):</font></div>
      <div class="panel-body">';
          
      $str.='<p><img src="'.__ROOT__.'/uploads/'.$info['face'].'" height="40px" width="40px"></p>';
      $str.='<p style="padding:10px;line-height:20px; font-size="10px;">'.$info['username'].' : <font color="blue">'.$data['content'].'</font></p>';          
      $str.='<a  href="#" style="margin-right:5px; float: right;">回复</a></div></div>';          

       if(M('comment')->data($data)->add()){
          if (I('post.isturn')) {
              if(M('weibo')->data(array(
              'content'=>I('post.comment'),
              'isturn'=>I('post.wid'),
              'time'=>time(),
              'uid'=>session('uid'),
              'ip'=>get_client_ip()
              ))->add()){
                M('userinfo')->where(array('uid'=>session('uid')))->setInc('weibo');
               M('weibo')->where(array('id'=>I('post.wid')))->setInc('turn');
              }

          }
           M('weibo')->where(array('id'=>I('post.wid')))->setInc('comment');

          echo   $str;
        }



  }
  function sendWeibo(){
 
 

    $picurl=I('post.mini');
    $ip = get_client_ip();
   $data=array('content'=>I('post.saytext'),'time'=>time(),'uid'=>session('uid'),'ip'=>$ip);
       if ( $wid=M('weibo')->data($data)->add()) {
            M('userinfo')->where(array('uid'=>session('uid')))->setInc('weibo',1);
             if (!empty($picurl)) {
              
               M('picture')->data(array('mini'=>$picurl,'max'=>$picurl,'medium'=>$picurl,'wid'=>$wid))->add();
              $this->success('发布成功...', '/Admin/index',1);
             }else{
             $this->success('发布成功...', '/Admin/index',1);
             }
       }else{
        $this->error('操作失败...','/Admin/index',1);
       }

    }
    

  
}
?>