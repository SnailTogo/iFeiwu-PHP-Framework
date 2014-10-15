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
<body style="background:url(assets/img/bg.png)">

<div class="wrap">
    <ul class="ul nav">
        <li <?php tpl_nav_active($this->pn, '');?>><a href="?"><i class="icon-home"></i></a><?php tpl_nav_arrow($this->pn, '');?></li>
        <li <?php tpl_nav_active($this->pn, 'works');?>><a href="?pn=works"><i class="icon-works"></i></a><?php tpl_nav_arrow($this->pn, 'works');?></li>
        <li <?php tpl_nav_active($this->pn, 'message');?>><a href="?pn=message"><i class="icon-message"></i></a><?php tpl_nav_arrow($this->pn, 'message');?></li>
        <li <?php tpl_nav_active($this->pn, 'weibo');?>><a href="?pn=weibo"><i class="icon-weibo"></i></a><?php tpl_nav_arrow($this->pn, 'weibo');?></li>
    </ul>
    <div class="main">
        <?php if( $this->pn=='' ):?>
        <div class="home">
            <div class="a"><img src="assets/img/home_01.jpg"></div>
            <div class="b"><img src="assets/img/home_02.jpg"></div>
        </div>
        <?php elseif( $this->pn=='works' ):?>
        <div class="works">
            <h1>作 品</h1>
            <ul class="ul items">
                <li><a href="#"><img src="assets/img/works_03.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_05.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_10.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_14.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_15.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_18.jpg"></a></li>
                <li><a href="#"><img src="assets/img/works_19.jpg"></a></li>
            </ul>
            <ul class="ul pages">
                <li><a href=""><i class="icon-arrow-right"></i></a></li>
                <li><a href=""><i class="icon-arrow-left"></i></a></li>
            </ul>
            <div class="open">
                <div class="box">
            		<div class="slider">
            			<a class="arrow-left"><i class="icon-arrow-left"></i></a>
                        <a class="arrow-right"><i class="icon-arrow-right"></i></a>
                        <div class="swiper-container">
                        	<div class="swiper-wrapper">
                        		<div class="swiper-slide"><img src="assets/img/test.jpg"></div>
                        	</div>
                        </div>
            		</div>
            		<div class="info">
            			<h2>W室内设计工作室logo</h2>
            			<p>他们清晰的了解业主的居住需求，能够用同龄人的眼光去帮他们塑造居住环境。以70后的态度，80后的精神去对待每个住宅空间。</p>
            		</div>
            		<a href="#" class="close">Close</a>
            	</div>
        	</div>
        </div>
        <?php elseif( $this->pn=='message' ):?>
        <form id="message_form" class="message">
            <input type="text" name="uname" value="" placeholder="姓名">
            <input type="email" name="email" value="" placeholder="邮箱">
            <textarea placeholder="留言内容"></textarea>
            <div class="btn"><button type="submit" id="message_send">发 送</button></div>
        </form>
        <?php elseif( $this->pn=='weibo' ):?>
        <div class="weibo">
            <iframe width="100%" height="550" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=550&fansRow=2&ptype=1&speed=0&skin=5&isTitle=0&noborder=0&isWeibo=1&isFans=0&uid=5015930794&verifier=737b934b&dpc=1"></iframe>
        </div>
        <?php endif;?>
    </div>
    <div style="clear:both"></div>
</div>

<script data-main="assets/js/main" src="assets/require.js"></script>
</body>
</html>