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

	$('.works img').on('click', function(){
		$('.works .open').show();
		fwscroll.refresh();
		document.addEventListener('touchmove', touchmove_handler, false);
	});
	
	if( $('.swiper-container').length ) {
		
		require(['swiper'], function() {
			var slider = $('.swiper-container').swiper({
				autoplay : 3000
			});
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
	
});


		

