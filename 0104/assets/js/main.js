require.config({
	baseUrl: 'assets/js',
	paths: {
		'swiper': '../swiper/script'
	},
	shim: {
		'swiper':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['swiper'], function() {

	$(window).resize(function() {
		$('.swiper-slide a').css('height',$(window).height()+'px');
	});
	$(window).trigger('resize');
	var slide_count = params.slide_count-1;
	var fwSwiper = $('.swiper-container').swiper({
		pagination : '.pagination',
		autoplay : 5000,
		keyboardControl : true,
		mousewheelControl : true,
		paginationClickable: true,
		grabCursor : true,
		onFirstInit : function(swiper){
			$('.logo').hide();
			if( slide_count>0 ) {
				$('.arrow-right').show();
			}
		},
		onSlideChangeStart: function(swiper){
			if( swiper.activeIndex==slide_count ) {
				$('.arrow-right').hide();
			} else {
				$('.arrow-right').show();
			}
			if( swiper.activeIndex==0 ) {
				$('.arrow-left').hide();
				$('.logo').hide();
			} else {
				$('.arrow-left').show();
				if( swiper.activeIndex==slide_count ){
					$('.logo').hide();
				} else {
					$('.logo').show();
				}
			}
		}
	});
	$('.arrow-left').on('click', function(e) {
		e.preventDefault();
		fwSwiper.swipePrev();
	});
	$('.arrow-right').on('click', function(e) {
		e.preventDefault();
		fwSwiper.swipeNext();
	});
	$('.logo').on('click', function(e){
		fwSwiper.swipeTo(0);
	});
	$('.swiper-pagination-switch').css('width',(100/params.slide_count)+'%');
	
	$(document).hover(function() {
		$('.arrow-right').show();
		$('.arrow-left').show();
		if( fwSwiper.activeIndex==slide_count ) {
			$('.arrow-right').hide();
		} else {
			$('.arrow-right').show();
		}
		if( fwSwiper.activeIndex==0 ) {
			$('.arrow-left').hide();
		} else {
			$('.arrow-left').show();
		}
	},
	function() {
		$('.arrow-right').hide();
		$('.arrow-left').hide();
	});
	
});


		

