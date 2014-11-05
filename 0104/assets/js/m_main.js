require.config({
	baseUrl: 'assets/js',
	paths: {},
	shim: {
		'response':['jquery'],
		'scrollIt':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['response','scrollIt'], function() {
	
	$(function(){
		$('.items').show();
		
		$('.pagination .switch').css('width',(100/params.slide_count)+'%');
		$('.pagination,.arrow-down').fadeIn();
		
		$.scrollIt({onPageChange:function(i){
			if( i==0 ) {
				$('header').fadeOut();
			} else {
				$('header').fadeIn();
			}
			$('.arrow-down').hide();
		}});
		
		var img_h = $('.items a:nth-child(1) img').height();

		$('.arrow-down').click(function(){
			var top = $(this).offset().top;
			$(this).css('top',top+'px').animate({
		      	opacity: 0,
	    		top: img_h,
		    }, 200, function(){
				$('body,html').animate({scrollTop: img_h}, 500);
		    });
			
		});
		
		$('.logo').click(function(){
			$('body,html').animate({scrollTop: 0}, 500);
		});
		
		var is_touch = true;
		$(window).on('touchmove',function(){
			if( is_touch==true ) {
				var top = $('.arrow-down').offset().top;
				$('.arrow-down').css('top',top+'px').animate({
			      	opacity: 0,
		    		top: img_h,
			    }, 200);
				is_touch = false;
			}
		})

	});

});


		

