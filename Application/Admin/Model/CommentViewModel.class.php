<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class CommentViewModel extends ViewModel {
			// 定义视图
	public $viewFields = array(
		'comment'=>array('id','content','time','_type'=>'LEFT'),
		'userinfo'=>array('face50'=>'face','username','uid','_on'=>'comment.uid=userinfo.uid')
		);

	}	
?>