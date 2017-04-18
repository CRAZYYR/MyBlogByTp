<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
		public function index(){
			echo("这里是用户资料页面！");
			dump($_GET);
		}
		/**
		 * 空操作
		 * @param  [type] $name [要传入的值]
		 * @return [type]       [description]
		 */
		public function _empty($name){
			$this->_getId($name);
		}
		/**
		 * 得到用户的ID
		 * @param  [type] $name [@的账户名字]
		 * @return [type]       [返回@账户名字的ID]
		 */
		public function _getId($name){
			$name=htmlspecialchars($name);
			$uid=M('userinfo')->where(array('username'=>$name))->getField('uid');
			if (!$uid) {
				redirect('/Admin/Index', 3, '用户不存在...');
			}else{
				redirect(U('index',array('id'=>$uid)));
			}

		}
	}
?>