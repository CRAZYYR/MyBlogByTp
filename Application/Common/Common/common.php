 <?php
  function enctyption($value,$type=0){
	$key=md5(C('MYKEY_ZS'));
	if (!$type) {
		return str_replace('=','',base64_encode($value^$key)) ;
	}else{
	$valu= base64_decode($value);
	return $valu^$key;
	}
	
}  
	
	/**
	 * 格式化时间
	 * @param  [type] $time [description]
	 * @return [type]       [description]
	 */
	function time_formt($time){
        //当前的时间
        $now=time();
        //今天的零分零秒
        $today=strtotime(date('y-m-d',$now));
       //时间差距
       $diff=$now-$time;
       $str='';
	       switch ($time) {
	       	case $diff<60:
	       		$str=$diff.'秒前';
	       		break;
	       	case $diff<3600:
	       		$str=floor($diff/60).'分前';
	       		break;
	       	case $diff<(3600*8):
	       		$str=floor($diff/3600).'小时前';
	       		break;
	       	case $time>$today:
	       		$str='今天 '.date('y-m-d H:i',$time);
	       		break;

	       	
	       	default:
	       		$str=date('y-m-d H:i',$time);
	       		break;
	       }
	       return $str;
    }
    function check_Url($content){
    //匹配网址
     // $content='[高兴]这个是 #qq_6# [开心]一个#qq_64#晴朗的早晨 www.zscool.top @帅子 你好![呵呵] [呵呵] #qq_1#' ;
    	$preg='/\s(?:http:\/\/)?([\w.]+[\w\/]*\.[\w.]+[\w\/]*\??[\w=\&+\%]*)/is';
    	
    	$content=preg_replace($preg,'<a href ="http://\\1" target="_blank" >\\1</a>',$content);
    	// 匹配@的用户  
    	$preg='/@(\S+)\s/is';
    	$content=preg_replace($preg,'<a href ="/Admin/User/\\1" target="_blank">@\\1</a>',$content);
 		//匹配微博表情
    	$preg='/\[(\S+?)\]/is';
    	preg_match_all($preg,$content,$arr);
 
    	$data=include('./Public/data/data.php');

    	if (!empty($arr[1])) {

    	foreach ($arr[1] as $key => $value) {
    		$name=array_search($value,$data);
    		if ($name) {

    			$content=str_replace($arr[0][$key],'<img src="'.__ROOT__.'/Public/qqface/dist/img/tieba/'.$name.'.jpg" title="'.$value.'"/>',$content);
    					}
    									}
    		}

    		//#qq_1#匹配qq表情
    	$preg='/\#\q\q\_(\d+?)\#/is';
    	preg_match_all($preg,$content,$arr);
    	
    		foreach ($arr[1] as $key => $value) {
    			if ($value<92) {
    				$content=str_replace($arr[0][$key],
    					'<img src="'.__ROOT__.'/Public/qqface/dist/img/qq/'.$value.'.gif" title="'.$value.'"/>',$content);

    			}

    		}
    		
    		return $content;
    }
  
?>