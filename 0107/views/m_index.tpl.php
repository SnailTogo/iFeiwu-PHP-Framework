<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->keys['global_logo_app'];?>">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/m_app.css">
<?php $fontcolor = $this->keys['global_font_color'];?>
<style>
.items .mask{color:<?php echo $fontcolor;?>;}
.fw_modal h2{color:<?php echo $fontcolor;?>;}
.fw_modal .mailto{background:<?php echo $fontcolor;?>;}
</style>
</head>
<body>
     
<div class="wrap" style="background-color:<?php echo $this->keys['global_bg_color'];?>;">
    <header><img src="<?php echo $this->keys['header_image_m'];?>"></header>
    <ul class="ul items">
        <?php include_once 'items_loading.tpl.php';?>
    </ul>
    <a id="more" href="javascript:;">More</a>
    <form class="message">
        <h2>Contact Us</h2>
        <input type="text" id="title" value="" placeholder="姓名">
        <input type="email" id="email" value="" placeholder="邮箱">
        <textarea id="content" placeholder="留言内容"></textarea>
        <button type="button" id="message_send" style="background:<?php echo $fontcolor;?>;">提 交</button>
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