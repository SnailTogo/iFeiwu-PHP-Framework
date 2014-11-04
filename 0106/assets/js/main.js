require.config({
	baseUrl: 'assets/js',
	paths: {
		'swiper': '../swiper/script'
	},
	shim: {
		'swiper':['jquery'],
		'response':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['swiper','response'], function() {

	$(window).resize(function() {
		$('.swiper-slide a').css('height',$(window).height()+'px');
	});
	$(window).trigger('resize');
	var slide_count = params.slide_count;
	var fwSwiper = $('.swiper-container').swiper({
		pagination : '.pagination',
		loop:true,
		autoplay : 5000,
		keyboardControl : true,
		mousewheelControl : true,
		paginationClickable: true,
		grabCursor : true,
		onFirstInit : function(swiper){
			var $slide_a = $(swiper.slides[1]).find('a');
			$slide_a.css('background-image','url('+$slide_a.data('image')+'?imageView2/2/w/'+Response.deviceW()+')');
			setTimeout(function(){
				$('.pagination').css('margin-top','-'+($('.pagination').height()-((slide_count-1)*55))+'px').show();
			},500);
		},
		onSlideChangeStart: function(swiper){
			
			var $slide_a = $(swiper.slides[swiper.activeIndex]).find('a');
			$slide_a.css('background-image','url('+$slide_a.data('image')+'?imageView2/2/w/'+Response.deviceW()+')');

			if( swiper.activeIndex==slide_count ) {
				$('.arrows').removeClass('arrow-right').addClass('arrow-left');
			}
			if( swiper.activeIndex==1 ) {
				$('.arrows').removeClass('arrow-left').addClass('arrow-right');
			} else {
				if( swiper.activeIndex==slide_count ){
					$('.logo').hide();
				} else {
					$('.logo').show();
				}
			}
		}
	});
	$(document.body).on('click','.arrow-right', function(e) {
		e.preventDefault();
		fwSwiper.swipeNext();
	});
	
	$(document.body).on('click','.arrow-left', function(e) {
		e.preventDefault();
		fwSwiper.swipePrev();
	});
	
	$('.logo').on('click', function(e){
		fwSwiper.swipeTo(0);
	});

});


		

