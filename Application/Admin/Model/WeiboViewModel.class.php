<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class WeiboViewModel extends ViewModel {
		// 定义视图
	public $viewFields = array(
	     'weibo'=>array('id','content','isturn','turn','time','keep','comment','uid','_type'=>'LEFT'),
	     'userinfo'=>array('intro','username','face50','_on'=>'weibo.uid=userinfo.uid','_type'=>'LEFT'),
	     'picture'=>array('mini','wid','_on'=>'weibo.id=picture.wid',)
	   
  	 );
	public function getALL($where){
		//return $this->where($where)->select();
$count      = $this->where($where)->count();// 查询满足要求的总记录数
$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
$show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
$list = $this->where($where)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		// 取出转发原微博的所有信息
	if($list){
		foreach ($list as $k => $v) {
			if ($v['isturn']) {
				$list[$k]['isturn']=$this->find($v['isturn']);

								}

							}
			}


		$result=array('list'=>$list,'page'=>$show);

		return $result;

			}



}
?>