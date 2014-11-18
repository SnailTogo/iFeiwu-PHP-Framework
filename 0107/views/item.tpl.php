<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

<div class="item">
    <h2>这是标题</h2>
    <div class="slider">
    	<a class="arrow-left"><i class="icon-arrow-left"></i></a>
        <a class="arrow-right"><i class="icon-arrow-right"></i></a>
        <div class="swiper-container">
            <?php foreach($this->imgs as $img):?>
        	<div class="swiper-wrapper"><img src="<?php echo $img['image_path'].'/'.$img['image'];?>"></div>
        	<?php endforeach;?>
        </div>
    </div>
    <p>这是描述</p>
    <a href="">询 价</a>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/swiper/script.js"></script>
<script>
var slider = $('.swiper-container').swiper({autoplay:3000,loop:true});
$('.arrow-left').on('click', function(e) {
	e.preventDefault();
	slider.swipePrev();
});
$('.arrow-right').on('click', function(e) {
	e.preventDefault();
	slider.swipeNext();
});

$(window.parent.document).find("#show_item iframe").load(function(){
	var main = $(window.parent.document).find("#show_item iframe");
	var height = $(document).height();
	if( height>0 ) main.height(height);
});
</script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>
</body>
</html>