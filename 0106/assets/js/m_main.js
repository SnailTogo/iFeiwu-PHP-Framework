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
		
		$.scrollIt({topOffset : -($('header').height()+27)});

		var w_rem = $('.pagination').width()/13;
		var w_rem = new Number(w_rem+1).toFixed(1);
		var w_rem = new Number(w_rem - 1).toFixed(0);
		$('.pagination').css({'width':w_rem+'rem','display':'block'}).show();
	});

});