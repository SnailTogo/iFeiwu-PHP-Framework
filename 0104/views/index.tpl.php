<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<title><?php echo $this->seo_title;?></title>
<meta name="keywords" content="<?php echo $this->seo_keys;?>" />
<meta name="description" content="<?php echo $this->seo_desc;?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<link rel="shortcut icon" href="assets/img/favicon.ico">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

<div class="device">
	<a class="arrow-left" href="#"><span></span></a>
	<a class="arrow-right" href="#"><span></span></a>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<img src="assets/img/pic2.png">
			</div>
			<div class="swiper-slide">
				<img src="assets/img/pic3.png">
			</div>
			<div class="swiper-slide">
				<img src="assets/img/pic4.png">
			</div>
			<div class="swiper-slide">
				<img src="assets/img/pic5.png">
			</div>
			<div class="swiper-slide">
				<div class="content-slide">
					<p class="title">Slide with HTML</p>
					<p>You can put any HTML inside of slide with any layout, not only images, even another Swiper!</p>
				</div>
			</div>
		</div>
	</div>
	<div class="pagination"></div>
</div>

	<script src="assets/js/jquery.js"></script>
	<script src="assets/swiper/script.min.js"></script>
	<script src="assets/js/app.js"></script>
</body>
</html>