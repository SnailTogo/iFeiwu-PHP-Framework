<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link href="<?php echo $this->keys['global_logo_app'];?>" rel="apple-touch-icon">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/114/h/114" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/120/h/120" rel="apple-touch-icon" sizes="120x120">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/iconfont/style.css">
<!--[if lt IE 8]><!-->
<link rel="stylesheet" href="assets/iconfont/ie7/ie7.css">
<!--<![endif]-->
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<a class="logo"><img src="<?php echo $this->keys['global_logo_web'];?>"></a>
<a class="arrow-left"><i class="icon-arrow-left"></i></a>
<a class="arrow-right"><i class="icon-arrow-right"></i></a>
<div class="swiper-container">
	<div class="swiper-wrapper">
	    <?php foreach($this->items as $item):?>
		<div class="swiper-slide">
		    <?php
		    $url = $item['url'];
		    $url = $url?$url:'#';
		    ?>
			<a href="<?php echo $url;?>" target="<?php echo $item['url_target'];?>" style="background-image:url('<?php echo $item['image'];?>');" title="<?php echo $item['title'];?>"></a>
		</div>
		<?php endforeach;?>
	</div>
</div>
<div class="pagination"></div>

<script>var params = {'slide_count':'<?php echo count($this->items);?>'}</script>
<script data-main="assets/js/main" src="assets/require.js"></script>
</body>
</html>