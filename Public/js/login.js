$(function(){
	//表单验证
	$('form[name=login]').validate({
	success: function(label) {
    // set &nbsp; as text for IE
    label.addClass("success");

	},
		rules: {

			user:{
			required:true,
			rangelength:[5,17]
		
		},
			password:{
			required:true
			}
    },
    messages: {
    	user:{
    		required:'账户不能为空！',
    		rangelength:'账户范围必须是5到17位！'
    	},
   
    		password:{
			required:'密码不能为空！'

			}
			
    }
	});
});
