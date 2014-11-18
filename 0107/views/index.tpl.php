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
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link href="<?php echo $this->keys['global_logo_app'];?>" rel="apple-touch-icon">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/114/h/114" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/120/h/120" rel="apple-touch-icon" sizes="120x120">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body style="background-color:<?php echo $this->keys['global_bg_color'];?>;">

<div class="wrap">
    <img src="<?php echo $this->keys['header_image_pc'];?>">
    <ul class="ul items">
        <?php foreach($this->items as $item):?>
        <li><a href="javascript:;" data-id="<?php echo $item['id'];?>"><img src="<?php echo $item['image_path'];?>/<?php echo $item['image'];?>" alt="<?php echo $item['title'];?>"></a></li>
        <?php endforeach;?>
    </ul>
    <ul class="ul pages">
        <?php echo $this->pagebar;?>
    </ul>
    <div class="overlay" id="show_item">
        <div class="dialog">
            <a href="#" class="close"><i class="icon-close"></i></a>
            <iframe width="100%" frameborder="0"></iframe>
        </div>
    </div>
	<div class="line">&nbsp;</div>
    <form class="message">
        <h2>Contact Us</h2>
        <div class="f1">
            <label>姓名</label>
            <input type="text" id="title" value="">
            <label>邮箱</label>
            <input type="email" id="email" value="">
        </div>
        <div class="f2">
            <label>留言内容</label>
            <textarea id="content"></textarea>
        </div>
        <div class="f3">
            <button type="button" id="message_send">提 交</button>
        </div>
    </form>
</div>
<script data-main="assets/js/main" src="assets/require.js"></script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>
</body>
</html>