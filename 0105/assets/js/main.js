require.config({
	baseUrl: 'assets/js',
	paths: {
		'swiper': '../swiper/script.min'
	},
	shim: {
		'browser':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['jquery','browser'], function() {

	$('.works .items a').on('click', function(){
		$('.works .open').show();
		$.getJSON('forms/get_works.php',{id:$(this).data('id')},function(json){
			if( json && json.item && json.imgs ) {
				$('.info h2').text(json.item.title);
				$('.info p').html(json.item.content);
				slider.removeAllSlides();
				var imgs_count = json.imgs.length;
				for (var i = 0; i < imgs_count; i++) {
					slider.appendSlide('<img src="'+json.imgs[i].image_path+'/'+json.imgs[i].image+'">');
				}
				if( imgs_count<=1 ) {
					slider.stopAutoplay();
					$('.arrow-left,.arrow-right').hide();
				} else {
					slider.startAutoplay();
					$('.arrow-left,.arrow-right').show();
				}
			}
			fwscroll.refresh();
			document.addEventListener('touchmove', touchmove_handler, false);
		});
	});
	
	if( $('.swiper-container').length ) {
		var slider;
		require(['swiper'], function() {
			slider = $('.swiper-container').swiper({autoplay:3000,loop:true});
			$('.arrow-left').on('click', function(e) {
				e.preventDefault();
				slider.swipePrev();
			});
			$('.arrow-right').on('click', function(e) {
				e.preventDefault();
				slider.swipeNext();
			});
			$('.works .open').on('click', function(e) {
				if( $(e.target).is('.icon-close') || $(e.target).is('.open')) {
					$('.works .open').hide();
					document.removeEventListener('touchmove', touchmove_handler, false);
				}
			});
		});
	}

	if( $.browser.msie&&$.browser.version<10){
		require(['placeholder'], function() {
			$('input,textarea').placeholder();
		});
	} else {
		if( $('#is-wrapper').length ) {
			var touchmove_handler = function (e) { e.preventDefault(); }
			var fwscroll = new IScroll('#is-wrapper',{mouseWheel:true,click:true});
			$(window).resize(function() {
				setTimeout(function(){
					fwscroll.refresh();
				},500);
			});
		}
	}
	
	if( $('#message_send').length ) {
		$('#message_send').click(function(){
			
			var uname = $('#uname').val();
			var email = $('#email').val();
			var content = $('#content').val();
			
			if( !uname ) {
				alert('请填写您的姓名！');
				$('#uname').focus();
				return false;
			}

			if (!email) {
				alert('请填写邮箱地址！');
				$('#email').focus();
				return false;
			} else {
				if (!/^\w+@\w+.\w+$/.test(email)) {
					alert('填写的邮箱地址格式不正确！');
					$('#email').focus();
					return false;
				}
			}
			
			if( !content ) {
				alert('请填写留言内容！');
				$('#content').focus();
				return false;
			}
			
			$(this).attr('disabled',true).css('background','#707070').text('请稍候...');
			
			$.post('forms/message.php',{'uname':uname,'email':email,'content':content},function(json){
				if( json.result=='success' ) {
					alert('留言成功，感谢您的支持！');
					location.reload();
				} else {
					alert('留言失败，请稍候再试！');
					$('#message_send').attr('disabled',true);
				}
			},'JSON');
		});
	}
	
});


		

