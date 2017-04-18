<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
	protected $tableName = 'user'; 
	//定义用户信息表关联关系
	protected $_link = array(
        	 'userinfo'  =>  array(
            'mapping_type'      => self::HAS_ONE,
            'foreign_key'       => 'uid'
         )
         );
	function insert($data){
	//$data=is_null($data)?$_POST:$data;
		 return $this->relation(true)->data($data)->add();

	}
}

