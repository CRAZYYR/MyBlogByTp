<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends CommonController {
		function index(){

			$user=M('userinfo');
					
			$user=$user->field(array(
				'username',
				'truename',
				'sex',
				'location',
				'constellation',
				'intro',
				'face180',
				'face50',
				'face80'
				))->where(array('uid'=>session('uid')))->find();

			$this->assign('user',$user);
			$this->display();
		}
			function editBase(){
				 
				 $data=array(
				 	'username'=>I('post.name'),
				 	'truename'=>I('post.truename'),
				 	'sex'=>I('post.Radio'),
				 	'location'=>I('post.pro')." ".I('post.city'),
				 	'constellation'=>I('post.star'),
				 	'intro'=>I('post.style')
				 	);
				$rs=M('userinfo')->where(array('uid'=>session('uid')))->save($data);
				if (!$rs) {
					# code...
					redirect('/Admin/System/index',3, '修改失败,请稍等...');
						}
				redirect('/Admin/System/index',3, '修改成功,请稍等...');
			}
			//修改用户头像
		public function Setimage(){
			if (!IS_POST) {
    		$this->error('操作失败',U('/Admin/System/index'),3);
    	}
			$where=array(
				'uid'=>session('uid')
				);
			$db=M('userinfo');
			$field=array('face180','face80','face50');
			$rs=$db->where($where)->field($field)->find();

			if ($db->where($where)->save($_POST)) {
				if(!empty($rs['face50'])){
					@unlink('./uploads/'.$rs['face50']);
				}
				$this->success('操作完成',U('/Admin/System/index'),3);
			}
			else{
			$this->error('操作失败',U('/Admin/System/index'),3);
		}
		}
		//修改密码
		public function UpdatePW(){
			$old=md5(I('post.oldpw'));
			$where=array('id'=>session('uid'));
			$rs=M('user')->where($where)->field('password')->find();
			if ($old==$rs['password']) {
				$rs=M('user')->where($where)->save(array('password'=>md5(I('post.newpw'))));
			redirect('/Admin/System/index',3,"修改成功，请稍等...");
				}else{
				$this->error('原密码输入错误！','/Admin/System/index',3);
			}
		}
		function checkpw(){

			$password=md5(I('post.oldpw'));
			$where=array('id'=>session('uid'));
			$rs=M('user')->where($where)->find();
			if ($rs['password']==$password) {
				echo true;
			}else{
				echo false;
			}
		}
}
?>