// $(function () {
// 	//城市联动
// 	var province = '';
// 	$.each(city, function (i, k) {
// 		province += '<option value="' + k.name + '" index="' + i + '">' + k.name + '</option>';
// 	});
// 	$('select[name=province]').append(province).change(function () {
// 		var option = '';
// 		if ($(this).val() == '') {
// 			option += '<option value="">请选择</option>';
// 		} else {
// 			var index = $(':selected', this).attr('index');
// 			var data = city[index].child;
// 			for (var i = 0; i < data.length; i++) {
// 				option += '<option value="' + data[i] + '">' + data[i] + '</option>';
// 			
// 		
// 		}
		
// 		$('select[name=city]').html(option);
// 	});

// 	//所在地默认选项
// 	address = address.split(' ');
// 	$('select[name=province]').val(address[0]);
// 	$.each(city, function (i, k) {
// 		if (k.name == address[0]) {
// 			var str = '';
// 			for (var j in k.child) {
// 				str += '<option value="' + k.child[j] + '" ';
// 				if (k.child[j] == address[1]) {
// 					str += 'selected="selected"';
// 				}
// 				str += '>' + k.child[j] + '</option>';
// 			}
// 			$('select[name=city]').html(str);
// 		}
// 	});



	
	
// });
$(function(){


	//城市联动
	var  pro= '';
	$.each(city, function (i, k) {
		pro += '<option value="' + k.name + '" index="' + i + '">' + k.name + '</option>';
	});
	$('select[name=pro]').append(pro).change(function () {
		var option = '';
		if ($(this).val() == '') {
			option += '<option value="">请选择</option>';
		} else {
			var index = $(':selected', this).attr('index');
			var data = city[index].child;
			for (var i = 0; i < data.length; i++) {
				option += '<option value="' + data[i] + '">' + data[i] + '</option>';
			}
		}
		
		$('select[name=city]').html(option);
	});


	//城市所在地
	address=address.split(' ');
	$('select[name=pro]').val(address[0]);
	//遍历
		$.each(city, function (i, k) {
		if (k.name == address[0]) {
		 		var str = '';
			for (var j in k.child) 
			{

				str+='<option value="'+k.child[j]+'" ';
				if (k.child[j] == address[1])
				{
					str += 'selected="selected"';
				}
			str += '>' + k.child[j] + '</option>';
	// 			str += '<option value="' + k.child[j] + '" ';
	// 			if (k.child[j] == address[1]) {
	// 				str += 'selected="selected"';
	// 			}
	// 		str += '>' + k.child[j] + '</option>';



			
			}
			$('select[name=city]').html(str);	
		
		}
	});
	// 	$.each(city, function (i, k) {
	// 	if (k.name == address[0]) {
	// 		var str = '';
	// 		for (var j in k.child) 
	// 		{
	// 			str += '<option value="' + k.child[j] + '" ';
	// 			if (k.child[j] == address[1]) {
	// 				str += 'selected="selected"';
	// 			}
	// 			str += '>' + k.child[j] + '</option>';
	// 		}
	// 		$('select[name=city]').html(str);
	// 	}
	// });
	 	//星座
	$('select[name=star]').val(constellation);
	//图像上传
	//
	$('#face').uploadify({
		 height        : 30,
       	 swf           : swfurl,
        uploader      : uploadurl,
        width         : 120,
        buttonImage		:'/Public/Uploadify/browse-btn.png',
        fileTypeDesc : '只能是图片哦',//选择图片说明
        fileTypeExts : '*.gif; *.jpg; *.png',
        formData  	  :{ 'session_id':sid},
        'onUploadStart' : function(file) {
            alert('开始上传 ' + file.name);
        },
        onUploadSuccess:function(file, data, response)
         {
          eval('var data='+data);
         //  alert('The file ' + file.name +'savepath'+file.savepath+ ' was successfully uploaded with a response of ' + response + ':' + data);
        if (data.status) {
        	var path=data.path+data.savename;
      	$('#face-img').attr('src',"/uploads/"+path);
      		$('input[name=face180]').val(path);
      		$('input[name=face80]').val(path);
      		$('input[name=face50]').val(path);

        	
        }
        else{
        	alert("图片错误！");
        }
    }
	});
	//
	//

});