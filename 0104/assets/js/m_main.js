require.config({
	baseUrl: 'assets/js',
	paths: {},
	shim: {
		'response':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['response'], function() {
	
	var is_touch = false;

	$('.arrow-down').click(function(){
		var top = $(this).offset().top;
		$(this).css('top',top+'px').animate({
	      	opacity: 0,
    		top: top+50,
	    }, 200, function(){
	    	if( !is_touch ) {
		    	var top_to = top + 100;
				$('body,html').animate({scrollTop: top_to}, 500);
	    	}
	    });
		
	});
	
	$(window).on('touchmove',function(){
		if( $(window).scrollTop()>0 ) {
			is_touch = true;
			$('.arrow-down').trigger('click');
			$(window).unbind('scroll');
		}
	})
	
	var w_top = $(window).scrollTop();
	if( w_top==0 ) {
		$(window).scroll(function () {
			$(this).unbind('scroll');
		});
	}

	if( w_top>0 ) {
		$('.arrow-down').hide();
	}
	
});


		

