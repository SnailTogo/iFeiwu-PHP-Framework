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
<link rel="stylesheet" href="assets/css/m_app.css">
</head>
<body data-responsejs='{ 
  "create": [{ 
    "prop": "width",
    "prefix": "src",
    "breakpoints": [0, 480, 640, 828]
  }]
}'>

<div class="wrap">
<a class="arrow-down"><i class="icon-arrow-down"></i></a>
<?php foreach($this->items as $item):?>
    <?php
    $url = $item['url'];
    $url = $url?$url:'#';
    ?>
	<a href="<?php echo $url;?>" target="<?php echo $item['url_target'];?>">
	   <img data-src0="<?php echo $item['image'];?>?imageView2/2/w/320" data-src480="<?php echo $item['image'];?>?imageView2/2/w/480" data-src640="<?php echo $item['image'];?>?imageView2/2/w/640" data-src828="<?php echo $item['image'];?>?imageView2/2/w/828" alt="<?php echo $item['title'];?>" />
	</a>
<?php endforeach;?>
</div>
<script data-main="assets/js/m_main" src="assets/require.js"></script>
</body>
</html>