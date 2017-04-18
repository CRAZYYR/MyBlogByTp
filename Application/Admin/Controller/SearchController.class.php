<?php
namespace Admin\Controller;
use Think\Controller;
class SearchController extends CommonController {
	public function searchUser(){
		$keyword=I('get.keyword');
		if ($keyword=="") {
		echo "请输入搜索的人或事！";	
		die;
		}
		$data=M('userinfo');
		$where=array(
			'username' =>array('like','%'.$keyword.'%'),
			'uid'	   =>array('NEQ',session('uid'))
			);
		// 分页
		
$count      = $data->where($where)->count('id');// 查询满足要求的总记录数
$Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
$show       = $Page->show();// 分页显示输出
//$all=$data->where($where)->select();
// 进行分页数据查询 
$list = $data->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

		// 分页结束
		$list=$this->attention($list);
	//	$this->assign('result',$result);
		$this->assign('keyword',$keyword);
		$this->assign('data',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}
	/**
	 * [attention description]
	 * @param  [array] $list [需要处理的结果]
	 * @return [array]       [处理完成后的结果集]
	 */
	public function attention($list){
			if (!$list) {
				return false;
			}
			$db=M('follow');
		
			foreach ($list as $key => $value) {
				//是否互相关注
$sql='(select `follow` from `hd_follow` where `follow`='. $value['uid'].' and `fans`='.session('uid').' ) union(select `follow` from `hd_follow` where `fans`='.$value['uid'].' and `follow`='.session('uid').' )';
				$attention=$db->query($sql);
			if (count($attention)==2) {
				$list[$key]['attention']=1;
			}else{
				$list[$key]['attention']=0;
				$where=array('follow'=>$value['uid'],'fans'=>session('uid'));
				$list[$key]['followed']=$db->where($where)->count();
		
			}
			}

			return $list;
	}

}
?>