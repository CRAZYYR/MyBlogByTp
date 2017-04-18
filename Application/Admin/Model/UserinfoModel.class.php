<?php
namespace Admin\Model;
use Think\Model;
class UserinfoModel extends Model {
	function Insert($data){
		
		return $this->data($data)->add();
	}

}
