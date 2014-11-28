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
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->keys['global_logo_app'];?>">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

<div class="wrap" style="background-color:<?php echo $this->keys['global_bg_color'];?>;">
    <img src="<?php echo $this->keys['header_image_pc'];?>">
    <ul class="ul items">
        <?php foreach($this->items as $item):?>
        <li><a href="javascript:;" data-id="<?php echo $item['id'];?>"><img src="<?php echo $item['image_path'];?>/<?php echo $item['image'];?>" alt="<?php echo $item['title'];?>"></a></li>
        <?php endforeach;?>
    </ul>
    <?php if( $this->pagebar ):?>
    <ul class="ul pages">
        <?php echo $this->pagebar;?>
    </ul>
    <?php endif;?>
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
        <input type="hidden" id="token" value="<?php echo $this->form_token;?>">
    </form>
</div>

<div class="fw_modal">
    <div class="fw_modal-body">
        <a href="javascript:;" class="fw_modal-close"></a>
        <h2></h2>
        <div class="slider">
        	<a class="arrow-left"></a>
            <a class="arrow-right"></a>
            <div class="swiper-container">
            	<div class="swiper-wrapper"></div>
            </div>
        </div>
        <div class="content"></div>
    </div>
</div>

<script>var is_mobile = '<?php echo $this->is_mobile;?>';</script>
<script data-main="assets/js/main" src="assets/require.js"></script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>

</body>
</html>