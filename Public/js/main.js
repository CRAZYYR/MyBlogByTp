$(function(){
	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup'),
		$form_modal_tab = $('.cd-switcher'),
		$tab_login = $form_modal_tab.children('li').eq(0).children('a'),
		$tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
		$main_nav = $('.main_nav');
   
		// 关注好友
  $('.follow_group').click(function(){

     var follow=$('input[name=followid]').val();
   	 var groupid=$('select[name=gid]').val();
   	 $.post(AddgroupList,{'follow':follow,'gid':groupid},function (data) {
            if (data.status) {
            	$('.guanzhu[uid='+follow+']').removeClass('guanzhu').html('	&radic;已关注');
              showTips(data.msg);
            }else{
              alert(data.msg);

            }


          },'json'
   	 	);

   	 $form_modal.removeClass('is-visible');
   });
	//閮㈡厱锝帮姜閭夛涧閮焦閮㈢毊锝版珌锝
	$main_nav.on('click', function(event){
			var id=$(this).children('a').attr('uid');
			$('input[name=followid]').val(id);
		if( $(event.target).is($main_nav) ) {
			// on mobile open the submenu
			$(this).children('li').toggleClass('is-visible');
		} else {
			// on mobile close submenu
			$main_nav.children('li').removeClass('is-visible');
			//show modal layer
			$form_modal.addClass('is-visible');	
			//show the selected form
			( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
		}

	});

	//閮㈠畾锝惰瑮鍜锝э椒鎳嗭絽閭忔硨銇勯疅绗們铚堟噯妞
	$('.cd-user-modal').on('click', function(event){
		if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
			$form_modal.removeClass('is-visible');
		}	
	});
	//缃橈骄铦岄伩锝ュ煁Esc閯欙焦閯掞焦閮㈠畾锝惰瑮鍜锝э椒鎳嗭絽閭忔硨銇勯疅绗們铚堟噯妞
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$form_modal.removeClass('is-visible');
	    }
    });

	//顏ワ交鏆ǎ妯婂厫铔燂溅闁
	$form_modal_tab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
	});

	function login_selected(){
		$form_login.addClass('is-selected');
		$form_signup.removeClass('is-selected');
		$tab_login.addClass('selected');
		$tab_signup.removeClass('selected');
	}

	function signup_selected(){
		$form_login.removeClass('is-selected');
		$form_signup.addClass('is-selected');
		$form_forgot_password.removeClass('is-selected');
		$tab_login.removeClass('selected');
		$tab_signup.addClass('selected');
	}
	 $('#create_group').click(function () {
           var groupLeft = ($(window).width() - $('#add-group').width()) / 2;
         var groupTop = $(document).scrollTop() / 2;
          var gpObj = $('#add-group').show().css({
             'left': ''+groupLeft+'px',
             'top' : ''+groupTop+'px'
         });
   
   });


//分组
   $('.add-group-sub').click(function () {
      var group=$('#gp-name').val();
      $.post(add_group_url, {
          'name': group
          }, function (data) {
            if (data.status) {
              showTips(data.msg);
            }else{
              alert(data.msg);

            }


          },'json');

         $('#add-group').hide(); 
   });
   /**
    *隐藏
    */
   $('.group-cencle').click(function(){
        $('#add-group').hide(); 
   });
   /**
    * 删除
    */
   $('#delete_group').click(function(){
      alert('老子要删除！');
   });
});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};
function createBg (id) {
  $('<div id = "' + id + '"></div>').appendTo('body').css({
    'width' : $(document).width(),
    'height' : $(document).height(),
    'position' : 'absolute',
    'top' : 0,
    'left' : 0,
    'z-index' : 2,
    'opacity' : 0.3,
    'filter' : 'Alpha(Opacity =0)',
    'backgroundColor' : '#000'
  });
}
/**
* 閬掑挷锝цВ锝健锝哥竟缈疆锝奸櫜锝磋寳
* @param  obj   缇傦郊闄诧酱鑼楅杸锝查鎱曪焦妯掞舰閮侊舰锝
* @param  element   閮㈢毊妤欓儮澶傛ぐ缇傦郊闄诧酱鑼楅杸锝查鎱曪焦妯掞舰閮侊舰锝
*/
function drag (obj, element) {
  var DX, DY, moving;
  element.mousedown(function (event) {
    DX = event.pageX - parseInt(obj.css('left')); //顏℃敇楫楋交璎楀拸锝モ垵锝ｎ仴娌嶉仏锝鳖仭鏀橀剻锝归柧鍊★舰鑲存們闄烇舰铔燂溅鑾
    DY = event.pageY - parseInt(obj.css('top'));  //顏℃敇楫楋交璎楀拸锝モ垵锝ｎ仴娌嶉仏锝鳖仭鏀橀剻锝归柧鍊★舰鑲存們闄烽剁磱锝
    moving = true;  //閯欙焦閯欙焦缇傦郊闄诧酱鑼楅杸锝叉瘮锝寔锝ｏ胶顏犺珛
  });
  $(document).mousemove(function (event) {
    if (!moving) return;
    var OX = event.pageX, OY = event.pageY; //顏熸伔閮㈡⊕锝帮姜缃橈骄璎楀拃锝㈡敇楫楋交璎楀拸锝モ埇锝呰瑮鍜忥桨 X閫嬪牑妞癥 閯掗埓锝甸棩锝
    var OW = obj.outerWidth(), OH = obj.outerHeight();  //缇傦郊闄诧酱鑼楅杸锝插彴锝恒倝锝㈤儊锝酱楫楋交闄烇舰铔燂溅绐讹骄绔囷僵闄
    var DW = $(window).width(), DH = $('body').height();  //顏э姜鎳枫亜閫嶉枿锝堕仺锝╅嬪牑妞伴儮锝
    var left, top;  //閯欙焦顏健锝搁儮妯掞僵锝￠剴閳存珌妞惰洘锝︾锝剧珖锝╅櫡
    left = OX - DX < 0 ? 0 : OX - DX > DW - OW ? DW - OW : OX - DX;
    top = OY - DY < 0 ? 0 : OY - DY > DH - OH ? DH - OH : OY - DY;
    obj.css({
      'left' : left + 'px',
      'top' : top + 'px'
    });
  }).mouseup(function () {
    moving = false; //顏℃敇楫楋交璎楀拸锝цВ锝¤珛锜毊锝帮礁闄诧酱椹燂降閫嬪伒锝郊闄诧酱鑼楅杸锝叉瘮锝寔锝ｏ胶顏犺珛
  });
}

/**设置提醒框**/
function showTips(tips,time,height){
  var windowWidth = $(window).width();height=height?height:$(window).height();
  time = time ? time : 2;
  var tipsDiv = '<div class="tipsClass">' + tips + '</div>';
  $( 'body' ).append( tipsDiv );
  $( 'div.tipsClass' ).css({
    'top' : height/2 + 'px',
    'left' : ( windowWidth / 2 ) - 100 + 'px',
    'position' : 'absolute',
    'padding' : '3px 5px',
    'background': '#670768',
    'font-size' : 14 + 'px',
    'text-align': 'center',
    'width' : '300px',
    'height' : '40px',
    'line-height' : '40px',
    'color' : '#fff',
    'font-weight' : 'bold',
    'opacity' : '0.9'
  }).show();
  setTimeout( function(){
    $( 'div.tipsClass' ).animate({
      top: height/2-50+'px'
    }, "slow").fadeOut();
  }, time * 1000);
};