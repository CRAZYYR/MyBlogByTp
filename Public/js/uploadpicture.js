
    $(function(){
      $('.blog_turn').click(function(){
        
        $('.hidden_id').val($(this).attr('id'));
      });
     $('#pic').uploadify({
    		 height        :30,
           	 swf           : swf,
            uploader      : uploader,
            width         :120,
            buttonImage		:'/Public/Uploadify/browse-btn.png',
            fileTypeDesc : '只能是图片哦',//选择图片说明
            fileTypeExts : '*.gif; *.jpg; *.png',
            formData  	  :{ 'session_id':sid},
            'onUploadStart' : function(file) {
                alert('开始上传 ' + file.name);
            },
            onUploadSuccess:function(file, data, response)
             {
                eval('var data ='+data);
              
             if (data.status) {
                $('input[name=mini]').val(data.path+data.savename);
                $('#uploadimg').fadeIn().find('img').attr('src','/uploads/'+data.path+data.savename);
                showTips('恭喜你,上传成功！');
              }else{
                alert('上传失败!');
              }
         }
    	});


    });
