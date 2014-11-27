<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/114/h/114">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/120/h/120">
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/57/h/57">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link rel="icon" sizes="192x192" href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/192/h/192">
<link rel="icon" sizes="128x128" href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/128/h/128">
<meta name="msapplication-TileImage" content="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/144/h/144">
<meta name="msapplication-TileColor" content="#222222">
<meta name="mobile-web-app-capable" content="yes">
<script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>

<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/m_app.css">
</head>
<body>
     
<div class="wrap" style="background-color:<?php echo $this->keys['global_bg_color'];?>;">
    <img src="<?php echo $this->keys['header_image_m'];?>">
    <ul class="ul items">
        <?php include_once 'items_loading.tpl.php';?>
    </ul>
    <a id="more" href="javascript:;">More</a>
    <form class="message">
        <h2>Contact Us</h2>
        <input type="text" id="title" value="" placeholder="姓名">
        <input type="email" id="email" value="" placeholder="邮箱">
        <textarea id="content" placeholder="留言内容"></textarea>
        <button type="button" id="message_send">提 交</button>
        <input type="hidden" id="token" value="<?php echo $this->form_token;?>">
    </form>
</div>

<div class="fw_modal">
    <div class="fw_modal-body">
        <a href="javascript:;" class="fw_modal-close"></a>
        <div class="item">
            <h2></h2>
            <div class="slider">
            	<a class="arrow-left"></a>
                <a class="arrow-right"></a>
                <div class="swiper-container">
                	<div class="swiper-wrapper"></div>
                </div>
            </div>
            <div class="content"></div>
            <a href="mailto:<?php echo $this->keys['email_mailto'];?>?subject=" class="mailto">给我发邮件</a>
        </div>
    </div>
</div>

<script>var is_mobile = '<?php echo $this->is_mobile;?>';</script>
<script data-main="assets/js/main" src="assets/require.js"></script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>

</body>
</html>