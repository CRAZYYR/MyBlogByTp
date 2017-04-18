<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>用户设置</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/pw.css">
	
	<link rel="stylesheet" type="text/css" href="
	/Public/bootstrap/css/bootstrap.css">
	<script src="/Public/jquery-3.1.1/jquery-3.1.1.js" type="text/javascript"></script>
	<script src="/Public/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript" src="/Public/js/city.js"></script>
	<!-- 加载city文件和密码验证 -->
		<script type="text/javascript" src="/Public/js/edit.js"></script>
		<script src="/Public/js/jquery.validate.js" type="text/javascript"></script>
		
		<!-- 加载插件 -->
		<link rel="stylesheet" type="text/css" href="/Public/Uploadify/uploadify.css">
	<script type="text/javascript" src="/Public/Uploadify/jquery.uploadify.min.js"></script>
	<!-- 定义全局变量 -->
	<script type="text/javascript">
	var swfurl="/Public/Uploadify/uploadify.swf";
	var uploadurl="<?php echo U('/Admin/Common/uploadface'); ?>";
	var sid='<?php echo session_id(); ?>';
	var  checkpw="<?php echo U('/Admin/System/checkpw'); ?>";
	</script>
</head>
<body>
	<?php include (THEME_PATH.'nav.html'); ?>
	<div class="container">
	<!-- 左边 -->
	<div class="col-md-3">
		<?php include(THEME_PATH.'left.html'); ?>
	</div>
	
	<!-- 个人信息设置 -->
	<div class="col-md-6">
		<div class="bs-example bs-example-tabs" 	data-example-id="togglable-tabs">
	    <ul id="myTabs" class="nav nav-tabs" role="tablist">
	      <li role="presentation" class=""><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">基本信息</a></li>
	      <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">修改头像</a></li>
	       <li role="presentation" class=""><a href="#pw" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">修改密码</a></li>
	      
	    </ul>
		    <div id="myTabContent" class="tab-content">
		    <!-- 基本信息 -->

		<?php include (THEME_PATH.THEME_NAME.'base.html'); ?>
		      <!-- 修改头像 -->
		      <?php include (THEME_PATH.THEME_NAME.'setimage.html'); ?>
		      <!-- 修改密码 -->
		         <?php include (THEME_PATH.THEME_NAME.'setpw.html'); ?>
		      
		    </div>
	  </div>


	</div>

</div>
</body>
</html>