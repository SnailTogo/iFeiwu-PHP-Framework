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
		var touchmove_handler = function (e) { e.preventDefault(); }
		var fwscroll = new IScroll('#is-wrapper',{mouseWheel:true,click:true});
		$(window).resize(function() {
			setTimeout(function(){
				fwscroll.refresh();
			},500);
		});
	}
	
	if( $('.message').length ) {
		$('#message_send').click(function(){
			$.post('forms/');
		});
	}
	
});


		

