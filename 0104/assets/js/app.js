var mySwiper = new Swiper('.swiper-container', {
	pagination : '.pagination',
	autoplay : 5000,
	freeModeFluid : true,
	keyboardControl : true,
	mousewheelControl : true,
	grabCursor : true,
	paginationClickable : true
})
$('.arrow-left').on('click', function(e) {
	e.preventDefault()
	mySwiper.swipePrev()
})
$('.arrow-right').on('click', function(e) {
	e.preventDefault()
	mySwiper.swipeNext()
})