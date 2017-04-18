$(function(){
	var imagurl=$('#img').attr('src');
	$('#img').click(function(){
		$(this).attr('src',imagurl);
	});
	//表单验证
	$('form[name=register]').validate({
		success:"valid",
		rules: {

			user:{
				cache:false,
			required:true,
			rangelength:[5,17],
			remote: {
			url: checkUser,     //后台处理程序
			type: "post",               //数据发送方式
			dataType:'json',           //接受数据格式   
			data: {                     //要传递的数据
			username: function() {
			return $('#username').val();
								}
					}
				}
			},
			//图片
			img:{		
			required:true,
			remote: {
			url: checkImg,     //后台处理程序
			type:"post",               //数据发送方式
			dataType:'json',           //接受数据格式   
			data: {                     //要传递的数据
			img: function(){
			return $('#img').val();
				}
				  }
					}
			},
			//昵称
			names:{
				required:true,
				rangelength:[2,10]
			},
			password:{
			required:true
			},
			password_again:{
				required:true,
				 equalTo: "#password"
			}
    },
    messages: {
    	img:{
    		required:'',
    		remote:''
    	},
    	user:{

    		remote:'帐号已存在！',
    		required:'账户不能为空！',
    		rangelength:'账户范围必须是5到17位！'
    	},
    	names:{
				required:'输入你的昵称！',
				rangelength:'请输入2到10位昵称！'
			},
    		password:{
			required:'密码不能为空！'

			},
			password_again:{
				required:'请确认密码！',
				 equalTo:'请确定密码相同！'
			}
			
    }
	});
});

