require.config({
	baseUrl: 'assets/js',
	paths: {
		'swiper': '../swiper/script'
	},
	shim: {
		'fw.modal':['jquery'],
		'swiper':['jquery'],
		'response':['jquery']
	},
	urlArgs: "v=20141128"
});
require(['fw.modal','swiper','response'], function() {

	var imgs_count = 0;
	var slider = $('.swiper-container').swiper({
	   autoplay:500000,
	   calculateHeight:true,
	   resizeReInit:true,
	   onSlideChangeStart: function(swiper){
			$('.arrow-left').show();
            $('.arrow-right').show();
            if( swiper.activeIndex==imgs_count-1 ) {
                $('.arrow-right').hide();
            }
            if( swiper.activeIndex==0 ) {
            	$('.arrow-left').hide();
            }
	   }
	});
    $('.arrow-left').on('click', function(e) {
    	e.preventDefault();
    	slider.swipePrev();
    });
    $('.arrow-right').on('click', function(e) {
    	e.preventDefault();
    	slider.swipeNext();
    });

	var fwm = $(document.body).fw_modal('.items a', {
		open: function ( e ){
			var item_id = $(e.currentTarget).data('id');
			$.getJSON('forms/item.php',{'id':item_id},function(json){
				if( json && json.item && json.imgs ) {
					$('.fw_modal h2').text(json.item.title);
					$('.fw_modal .content').html(json.item.content);
					if( json.keys ) {
						$('.fw_modal .content').append('<a href="mailto:'+json.keys.email_mailto+'?subject='+json.item.title+'" class="mailto">给我发邮件</a>');
					}
					imgs_count = json.imgs.length;
					for (var i = 0; i < imgs_count; i++) {
						slider.appendSlide(slider.createSlide('<img src="'+json.imgs[i].image_path+'/'+json.imgs[i].image+'">'));
					}
					if( imgs_count<=1 ) {
						slider.stopAutoplay();
						$('.arrow-left,.arrow-right').hide();
					} else {
						slider.startAutoplay();
						$('.arrow-right').show();
					}
					setTimeout(function(){
						slider.reInit();
					},300);
				}
			});
		},
		close: function ( e ) {
			slider.removeAllSlides();
			$('.swiper-wrapper').attr('style','');
			$('.arrow-left,.arrow-right').hide();
		}
	});
	
	$('.items a').hover(
		function() {
			var title = $(this).find('img').attr('alt');
			$(this).append('<div class="mask">'+title+'</div>');
		}, function() {
			$(this).find('.mask').remove();
		}
	);
	
	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function () {
		setTimeout(function(){
			slider.resizeFix();
		},300);
    }, false);

	if( $('#more').length ) {
		$('#more').click(function(){
			$('#more').text('loading...');
			var page = $(this).data('page');
			$.getJSON('forms/items_loading.php',{'page':page},function(json) {
				if (json.page > 0) {
					$('#more').data('page', json.page).html('More');
				} else {
					$('#more').remove();
				}
				if (json.html != '') {
					$('.items').append(json.html);
				}
			});
			
		});
	}
	
	if( $('#message_send').length ) {
		$('#message_send').click(function(){
			
			var token = $('#token').val();
			var title = $('#title').val();
			var email = $('#email').val();
			var content = $('#content').val();
			
			if( !title ) {
				alert('请填写您的姓名！');
				$('#title').focus();
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

			$.post('forms/message.php',{'title':title,'email':email,'content':content,'token':token},function(json){
				if( json.result=='success' ) {
					alert('留言成功，感谢您的支持！');
					location.reload();
				} else {
					alert('留言失败，请稍候再试！');
					$('#message_send').attr('disabled',false).css('background','#846F50').text('提 交');
				}
			},'JSON');
		});
	}
	
});


		

