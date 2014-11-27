<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/<?php echo $_GET['d'];?>app.css">
</head>
<body style="overflow:hidden;background:#EEEBEC;">

<div class="item">
    <h2><?php echo $this->item['title'];?></h2>
    <div class="slider">
    	<a class="arrow-left"></a>
        <a class="arrow-right"></a>
        <div class="swiper-container">
        	<div class="swiper-wrapper">
        	<?php foreach($this->imgs as $img):?>
        	   <div class="swiper-slide" data-image="<?php echo $img['image_path'].'/'.$img['image'];?>"><img></div>
        	<?php endforeach;?>
        	</div>
        </div>
    </div>
    <div class="content"><?php echo $this->item['content'];?></div>
    <?php if( $this->keys['email_mailto'] ):?>
    <a href="mailto:<?php echo $this->keys['email_mailto'];?>?subject=<?php echo $this->item['title'];?>" class="mailto">给我发邮件</a>
    <?php endif;?>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/swiper/script.js"></script>
<script>
var slider;
$(function(){
	
	var slide_count = '<?php echo count($this->imgs);?>';
	slider = $('.swiper-container').swiper({
	   autoplay:500000,
	   calculateHeight:true,
	   onInit : function(swiper){
	       if( slide_count-1>0 ) {
	           $('.arrow-right').show();
	       }
	   },
	   onFirstInit : function(swiper){
			var $slide = $(swiper.slides[0]);
			$slide.find('img').attr('src', $slide.data('image'));
       },
	   onSlideChangeStart: function(swiper){
	   
	        var $slide = $(swiper.slides[swiper.activeIndex]);
	        $slide.find('img').attr('src', $slide.data('image'));
	       
            $('.arrow-left').show();
            $('.arrow-right').show();
            if( swiper.activeIndex==slide_count-1 ) {
                $('.arrow-right').hide();
            }
            if( swiper.activeIndex==0 ) {
            	$('.arrow-left').hide();
            }
	   }
	});
    $('.arrow-left').on('click', function(e) {
    	e.preventDefault();
    	slider.swipePrev();
    });
    $('.arrow-right').on('click', function(e) {
    	e.preventDefault();
    	slider.swipeNext();
    });
    
    $(window.parent.document).find("#ifr_item").load(function(){
    setTimeout(function(){
    var main = $(window.parent.document).find("#ifr_item");
    	var height = $(document).height();
    	if( height>0 ) main.height(height);
    }, 1000);
    	
    });

});
</script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>
</body>
</html>