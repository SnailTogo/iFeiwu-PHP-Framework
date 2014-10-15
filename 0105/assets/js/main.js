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
	});
	
	if( $('.swiper-container').length ) {
		
		require(['swiper'], function() {
			var fwSwiper = new Swiper('.swiper-container', {
				autoplay : 3000,
				mousewheelControl : true
			});
			$('.arrow-left').on('click', function(e) {
				e.preventDefault();
				fwSwiper.swipePrev();
			});
			$('.arrow-right').on('click', function(e) {
				e.preventDefault();
				fwSwiper.swipeNext();
			});
			$('.works .open').on('click', function(e) {
				if( $(e.target).is('.close') || $(e.target).is('.open')) {
					$('.works .open').hide();
				}
			});
		});
	}

	if( $.browser.msie&&$.browser.version<10){
		require(['placeholder'], function() {
			$('input, textarea').placeholder();
		});
	}
	
});

