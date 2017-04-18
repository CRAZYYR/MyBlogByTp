<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>demo</title>
<!-- 加载插件 -->
<link rel="stylesheet" type="text/css" href="/Public/simditor-1.0.5/styles/font-awesome.css" /> 
<link rel="stylesheet" type="text/css" href="/Public/simditor-1.0.5/styles/simditor.css" />
	<script src="/Public/jquery-3.1.1/jquery-3.1.1.js" type="text/javascript"></script>	
		<link rel="stylesheet" type="text/css" href="/Public/Uploadify/uploadify.css">
		
	<script type="text/javascript" src="/Public/Uploadify/jquery.uploadify.min.js"></script>

	<script type="text/javascript" src="/Public/js/uploadpicture.js"></script>
		<script src="/Public/bootstrap/js/bootstrap.js" type="text/javascript"></script>
		
  </script> <script type="text/javascript" src="/Public/simditor-1.0.5/scripts/js/simditor-all.js"></script>
</head>
<script type="text/javascript">
    var swf= "/Public/Uploadify/uploadify.swf";
    	
    var uploader="<?php  echo U('/Admin/Common/uploadpicture'); ?>";
    var sid='<?php echo session_id(); ?>';
</script>
<body>





<dl style="list-style:none;">

   <dd>用来计算的仪器 ... ...</dd> <dd>用来计算的仪器 ... ...</dd>

</dl>

</body>
</html>