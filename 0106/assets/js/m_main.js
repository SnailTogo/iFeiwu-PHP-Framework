require.config({
	baseUrl: 'assets/js',
	paths: {},
	shim: {
		'response':['jquery'],
		'smint':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['response','smint'], function() {

	$('header').smint({
    	'scrollSpeed' : 1000,
    	'mySelector' : 'li'
    });
	
	$('.pagination').css({'width':($('.pagination').width()/13)+'rem','display':'block'}).show();
//	alert($('.items li img').height());
//	$('.items li').height($('.items li img').height());
//	
//	
	
	
});