<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<!--[if lt IE 9]><script>window.location.href='http://www.ifeiwu.com/ie-browser-upgrade.html';</script><![endif]-->
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->keys['global_logo_app'];?>">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<a class="logo"><img src="<?php echo $this->keys['global_logo_web'];?>"></a>
<a class="arrows arrow-right"></a>
<div class="swiper-container">
	<div class="swiper-wrapper">
	    <?php foreach($this->items as $item):?>
		<div class="swiper-slide">
		    <?php
		    $url = $item['url'];
		    $url = $url?$url:'#';
		    ?>
			<a href="<?php echo $url;?>" target="<?php echo $item['url_target'];?>" data-image="<?php echo $item['image'];?>" title="<?php echo $item['title'];?>"></a>
		</div>
		<?php endforeach;?>
	</div>
</div>
<div class="pagination"></div>

<script>var params = {'slide_count':'<?php echo count($this->items);?>'}</script>
<script data-main="assets/js/main" src="assets/require.js"></script>
</body>
</html>